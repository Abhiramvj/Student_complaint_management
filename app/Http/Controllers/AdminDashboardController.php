<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Department;
use App\Models\User;
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

}
