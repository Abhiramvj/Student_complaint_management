<?php

namespace App\Http\Controllers;

use App\Jobs\SendComplaint;
use App\Jobs\SendComplaintNotification;
use App\Mail\ComplaintSubmitted;
use App\Models\Complaint;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StudentDashboardController extends Controller
{
    public function index()
    {
        return view('student.dashboard');
    }
   public function recent(Request $request)
{
    $student = Auth::user();

    $query = Complaint::where('user_id', $student->id)
                ->with(['department', 'complaintResponses.user'])
                ->latest();

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $complaints = $query->get();

    $totalCount = Complaint::where('user_id', $student->id)->count();
    $pendingCount = Complaint::where('user_id', $student->id)->where('status', 'pending')->count();
    $resolvedCount = Complaint::where('user_id', $student->id)->where('status', 'resolved')->count();
    $inProgressCount = Complaint::where('user_id', $student->id)->where('status', 'in_progress')->count();

    $statuses = Complaint::select('status')->distinct()->pluck('status');
    $allStatuses = ['pending', 'in_progress', 'resolved'];

    return view('student.recent', compact(
        'complaints', 'totalCount', 'pendingCount',
        'resolvedCount', 'inProgressCount', 'allStatuses', 'statuses'
    ));
}

public function recentFilter(Request $request)
{
    $status = $request->input('status');

    $complaints = Complaint::with(['department', 'complaintResponses.user'])
        ->when($status, function ($query, $status) {
            if ($status !== '') {
                $query->where('status', $status);
            }
        })
        ->latest()
        ->get();

    $html = view('student.partials.student-recent', compact('complaints'))->render();

    return response()->json(['html' => $html]);
}


    public function create()
    {
        $departments = Department::all();
        return view('student.complaint',compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'attachment' => ['nullable', 'file', 'max:2048'] ,
        ]);
        $complaint = new Complaint();
        $complaint->user_id = auth()->user()->id;
        $complaint->department_id= $validated['department'];
        $complaint->title = $validated['title'];
        $complaint->description = $validated['description'];

        if ($request->hasFile('attachment')) {
    $path = $request->file('attachment')->store('attachments', 'public');
    $complaint->attachment = $path;
}
        $complaint->save();

        SendComplaint::dispatch($complaint);

        return redirect()->back()->with('success','Complaint submitted successfully!');
    }

}
