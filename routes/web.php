<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\User\ReportController;
use App\Http\Controllers\HeadStaff\ManageStaffController;
use App\Http\Controllers\HeadStaff\HeadStaffDashboardController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware(['auth', 'verified', 'role:head_staff'])->group(function () { 

    Route::get('/dashboard/head/head', [DashboardController::class, 'headDashboard'])->name('dashboard.head');

    // Kelola staff
    Route::get('/head-staff/staff', [ManageStaffController::class, 'index'])->name('headstaff.staff.index');
    Route::get('/head-staff/staff/create', [ManageStaffController::class, 'create'])->name('headstaff.staff.create');
    Route::post('/head-staff/staff', [ManageStaffController::class, 'store'])->name('headstaff.staff.store');
    Route::get('/head-staff/staff/{user}/edit', [ManageStaffController::class, 'edit'])->name('headstaff.staff.edit');
    Route::put('/head-staff/staff/{user}', [ManageStaffController::class, 'update'])->name('headstaff.staff.update');
    Route::delete('/head-staff/staff/{user}', [ManageStaffController::class, 'destroy'])->name('headstaff.staff.destroy');

    Route::get('/head-staff/staff/export', [ManageStaffController::class, 'export'])->name('headstaff.staff.export');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'user') {
        return redirect()->route('dashboard.user');
    } elseif ($user->role === 'staff') {
        return redirect()->route('dashboard.staff');
    } elseif ($user->role === 'head_staff') {
        return redirect()->route('dashboard.head');
    }

    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
