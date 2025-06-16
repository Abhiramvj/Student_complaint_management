<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    public function index() {
       $students = User::where('role','student')->get();
       return view('admin.student.index',compact('students'));
    }
    public function destroy($id) {
        $student = User::where('role','student')->findOrFail($id);
        $student->delete();
        return response()->json(['success' => true]);
    }
}
