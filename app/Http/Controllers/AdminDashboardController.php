<?php

namespace App\Http\Controllers;

use App\Jobs\SendResponse;
use App\Models\Complaint;
use App\Models\ComplaintResponse;
use App\Models\Department;
use App\Models\User;
use App\View\Components\StatusBadge;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function recent() {
        $totalComplaints = Complaint::count();
        $activeStudents = User::where('role','student')->count();
        $departmentCount = Department::count();
        $pendingComplaints = Complaint::where('status','pending')->count();
         $complaints = Complaint::with('department')->latest()->take(5)->get();

        return view('admin.section.main',compact('totalComplaints','activeStudents','departmentCount','pendingComplaints','complaints'));
    }

    public function all(Request $request)
{
     $complaints = Complaint::with('department')->latest()->paginate(5);

    if ($request->ajax()) {
        return view('admin.partials.complaints', compact('complaints'))->render();
    }


    return view('admin.section.allcomplaints', compact('complaints'));
}
public function showAJAX($id) {
        $complaint = Complaint::with('department')->findOrFail($id);
          $statuses = ['pending', 'in_progress', 'resolved'];
    return view('admin.partials.details', compact('complaint','statuses'));

    }

    public function updateStatus(Request $request,$id)
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

public function response($id)
{
    $complaint = Complaint::with('department', 'complaintResponses.user')->findOrFail($id);
    return view('admin.response', compact('complaint'));
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

}
