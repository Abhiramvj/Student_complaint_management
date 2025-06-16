<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDepartmentController extends Controller
{
    public function index() {
        $departments = Department::get();
        return view('admin.department.index',compact('departments'));
    }


        public function create(Request $request) {



        return view('admin.department.create');

}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:departments,name',
        'head_name' => 'required|string|max:255',
        'head_email' => 'required|email|unique:users,email',
        'head_password' => 'required|string|min:6',
    ]);

    $department = Department::create([
        'id' => $request->id,
        'name' => $request->name,
    ]);

    User::create([
        'name' => $request->head_name,
        'email' => $request->head_email,
        'password' => Hash::make($request->head_password),
        'role' => 'department_head',
        'department_id' => $department->id,
    ]);

     $departments = Department::all();
    return view('admin.department.index', compact('departments'));
}
public function edit($id)
{
    $department = Department::findOrFail($id);
    $head = User::where('department_id', $id)->where('role', 'department_head')->first();

    return view('admin.department.edit', compact('department', 'head'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'head_name' => 'required|string|max:255',
        'head_email' => 'required|email',
    ]);

    $department = Department::findOrFail($id);
    $department->update(['name' => $request->name]);

    $head = User::firstOrNew(['department_id' => $id, 'role' => 'department_head']);
    $head->name = $request->head_name;
    $head->email = $request->head_email;
    if ($request->head_password) {
        $head->password = Hash::make($request->head_password);
    }
    $head->role = 'department_head';
    $head->department_id = $id;
    $head->save();

    if ($request->ajax()) {
        $departments = Department::all();

        return view('admin.department.partials.table', compact('departments'))->render();
    }

    return redirect()->route('admin.department.index')->with('success', 'Department updated');
}
public function destroy($id)
{
    $department = Department::findOrFail($id);

    Complaint::where('department_id', $department->id)->delete();


    User::where('department_id', $department->id)->update(['department_id' => null]);

    $department->delete();

    return response()->json(['success' => true]);
}




}
