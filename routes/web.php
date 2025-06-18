<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDepartmentController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DepartmentDashboardController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontEndController::class,'index'])->middleware(['web']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/dashboard',[AdminDashboardController::class,'index']) ->name('admin.dashboard');
    Route::get('/admin/dashboard/main',[AdminDashboardController::class,'recent'])->name('admin.dashboard.main');
    Route::get('/admin/dashboard/allcomplaints',[AdminDashboardController::class,'all'])->name('admin.dashboard.all');
    Route::get('/admin/dashboard/department',[AdminDepartmentController::class,'index'])->name('admin.department.index');
    Route::get('/admin/dashboard/department/create',[AdminDepartmentController::class,'create'])->name('admin.department.create');
    Route::post('/admin/dashboard/department/create',[AdminDepartmentController::class,'store'])->name('admin.department.store');
    Route::get('/admin/dashboard/department/{id}/edit',[AdminDepartmentController::class,'edit'])->name('admin.department.edit');
    Route::put('/admin/dashboard/department/{id}/edit',[AdminDepartmentController::class,'update'])->name('admin.department.update');
    Route::delete('/admin/dashboard/department/{id}/delete',[AdminDepartmentController::class,'destroy'])->name('admin.department.destroy');
    Route::get('/admin/dashboard/student',[AdminStudentController::class,'index'])->name('admin.student.index');
    Route::delete('/admin/dashboard/student/{id}/delete',[AdminStudentController::class,'destroy'])->name('admin.student.destroy');
    Route::get('/admin/dashboard/complaints/{id}',[AdminDashboardController::class,'showAJAX'])->name('.view.complaints');
    Route::patch('/admin/complaints/{id}/status', [AdminDashboardController::class, 'updateStatus'])->name('admin.complaints.updateStatus');
     Route::get('/admin/dashboard/all/{id}/response',[AdminDashboardController::class,'response'])->name('admin.response');
     Route::post('/admin/dashboard/all/{id}/response', [AdminDashboardController::class, 'storeResponse'])->name('admin.response.store');
});


    Route::middleware(['auth','role:student'])->group(function () {
        Route::get('/student/dashboard',[StudentDashboardController::class,'index'])->name('student.dashboard');
        Route::get('/student/dashboard/recent',[StudentDashboardController::class,'recent'])->name('student.recent');
        Route::get('/student/recent/filter', [StudentDashboardController::class, 'recentFilter'])->name('student.recent.filter');
        Route::get('/student/dashboard/complaint',[StudentDashboardController::class,'create'])->name('student.complaint');
        Route::post('student/dashboard/complaint',[StudentDashboardController::class,'store'])->name('student.complaint.submit');
        Route::get('/student/dashboard/complaints/{id}',[StudentDashboardController::class,'showAJAX'])->name('student.view.complaints');

    });

Route::middleware(['auth','role:department_head'])->group(function () {
    Route::get('/department/dashboard',[DepartmentDashboardController::class,'index'])->name('department.dashboard');
    Route::get('/department/dashboard/main',[DepartmentDashboardController::class,'recent'])->name('department.recent');
    Route::get('/department/dashboard/all',[DepartmentDashboardController::class,'all'])->name('department.all');
    Route::patch('department/complaints/{id}/status', [DepartmentDashboardController::class, 'update'])->name('department.complaints.updateStatus');
    Route::get('/department/dashboard/all/{id}/response',[DepartmentDashboardController::class,'response'])->name('department.response');
    Route::post('/department/dashboard/all/{id}/response', [DepartmentDashboardController::class, 'storeResponse'])->name('department.response.store');
    Route::get('/department/dashboard/filter', [DepartmentDashboardController::class, 'filter'])->name('department.dashboard.filter');
    Route::get('/department/dashboard/complaints/{id}',[DepartmentDashboardController::class,'showAJAX'])->name('department.view.complaints');

});
