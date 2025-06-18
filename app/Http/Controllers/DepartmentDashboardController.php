<?php

namespace App\Http\Controllers;

use App\Jobs\SendResponse;
use App\Models\Complaint;
use App\Models\ComplaintResponse;
use App\View\Components\StatusBadge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'department_head' || !$user->department_id) {
            abort(403, 'Unauthorized');
        }
        $statuses = ['pending', 'in_progress', 'resolved'];
        $complaints = Complaint::where('department_id', $user->department_id)->with('user')->latest()->get();
         $totalCount = Complaint::where('department_id',$user->department_id)->count();
         $pendingCount = Complaint::where('department_id',$user->department_id)->where('status', 'pending')->count();
         $resolvedCount = Complaint::where('department_id',$user->department_id)->where('status', 'resolved')->count();
         $inProgressCount = Complaint::where('department_id',$user->department_id)->where('status', 'in_progress')->count();
        return view('department.dashboard', compact('complaints','totalCount','pendingCount','resolvedCount','inProgressCount','statuses'));
    }

  public function filter(Request $request)
{
    $user = Auth::user();
    if ($user->role !== 'department_head' || !$user->department_id) {
        abort(403, 'Unauthorized');
    }

    $statuses = ['pending', 'in_progress', 'resolved'];
    $query = Complaint::where('department_id', $user->department_id);

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $complaints = $query->latest()->get();

    if ($request->ajax()) {
        return view('department.partials.complaints', compact('complaints', 'statuses'));
    }

    return view('department.allcomplaints', compact('complaints', 'statuses'));
}


    public function update(Request $request,$id)
{

    $request->validate([
        'status' => 'required|in:pending,in_progress,resolved',
    ]);

    $complaint = Complaint::findOrFail($id);
    $complaint->status = $request->status;
    $complaint->save();

    $component = new StatusBadge($complaint->status);
    $view = $component->render();
    $badgeHtml = $view->with(['status' => $complaint->status])->render();


    return response()->json(['success' => 'true',
    'badge_html' => $badgeHtml]);
}

public function recent()
{
    $user = Auth::user();

    if ($user->role !== 'department_head' || !$user->department_id) {
        abort(403, 'Unauthorized');
    }

    $statuses = ['pending', 'in_progress', 'resolved'];

    $complaints = Complaint::where('department_id', $user->department_id)->with('department')->latest()->take(5)->get();

    $totalCount = Complaint::where('department_id', $user->department_id)->count();
    $pendingCount = Complaint::where('department_id', $user->department_id)->where('status', 'pending')->count();
    $resolvedCount = Complaint::where('department_id', $user->department_id)->where('status', 'resolved')->count();
    $inProgressCount = Complaint::where('department_id', $user->department_id)->where('status', 'in_progress')->count();

    return view('department.recent', compact('complaints','totalCount','pendingCount','resolvedCount','inProgressCount','statuses'));
}

public function all()
{
    $user = Auth::user();

    if ($user->role !== 'department_head' || !$user->department_id) {
        abort(403, 'Unauthorized');
    }

    $statuses = ['pending', 'in_progress', 'resolved'];

    $complaints = Complaint::where('department_id', $user->department_id)->with(['department', 'user'])->latest()->get();

    return view('department.allcomplaints', compact('complaints', 'statuses'));
}

public function response($id)
{
    $complaint = Complaint::with('department', 'complaintResponses.user')->findOrFail($id);
    return view('department.response', compact('complaint'));
}

public function storeResponse(Request $request, $id)
{
        $request->validate([
            'message' => 'required|string'
        ]);

        $response = ComplaintResponse::create([
            'complaint_id' => $id,
            'user_id' => auth()->id(),
            'message' => $request->message
        ]);

          $complaint = $response->complaint()->with('user')->first();

        SendResponse::dispatch($complaint,$response);

        return response()->json(['success' => true]);

    }

    public function showAJAX($id) {
        $complaint = Complaint::with('department')->findOrFail($id);
          $statuses = ['pending', 'in_progress', 'resolved'];
    return view('department.partials.details', compact('complaint','statuses'));

    }
}






