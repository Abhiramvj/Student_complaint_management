<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
         $roles = Role::whereIn('name', ['student', 'department_head'])->get();
    return view('auth.register', compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
   public function store(Request $request): RedirectResponse
{
    Log::info('Registration attempt', $request->all());
    try {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'role' => ['required', 'in:student,department_head'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        Log::info('Validation passed', $validated);
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation failed', $e->errors());
        throw $e;
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'password' => Hash::make($request->password),
    ]);
    Log::info('User created', ['user' => $user]);

    $user->assignRole($request->role);
    event(new Registered($user));
    Auth::login($user);

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('student')) {
        return redirect()->route('student.dashboard');
    } elseif ($user->hasRole('department_head')) {
        return redirect()->route('department.dashboard');
    }

    return redirect('/');
}

}
