<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\User\ReportController;
use App\Http\Controllers\HeadStaff\ManageStaffController;
use App\Http\Controllers\HeadStaff\HeadStaffDashboardController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\ExportReportController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware(['auth', 'verified', 'role:head_staff'])->group(function () { 

    Route::get('/dashboard/head/head', [DashboardController::class, 'headDashboard'])->name('dashboard.head');

    Route::get('/head-staff/staff', [ManageStaffController::class, 'index'])->name('headstaff.staff.index');
    Route::get('/head-staff/staff/create', [ManageStaffController::class, 'create'])->name('headstaff.staff.create');
    Route::post('/head-staff/staff', [ManageStaffController::class, 'store'])->name('headstaff.staff.store');
    Route::get('/head-staff/staff/{user}/edit', [ManageStaffController::class, 'edit'])->name('headstaff.staff.edit');
    Route::put('/head-staff/staff/{user}', [ManageStaffController::class, 'update'])->name('headstaff.staff.update');
    Route::delete('/head-staff/staff/{user}', [ManageStaffController::class, 'destroy'])->name('headstaff.staff.destroy');

    Route::get('/head-staff/staff/export', [ManageStaffController::class, 'export'])->name('headstaff.staff.export');
});

Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/dashboard/user', [DashboardController::class, 'userDashboard'])->name('dashboard.user');

    Route::get('/reports/create', [ReportController::class, 'create'])->name('user.reports.create');

    Route::get('/reports/manage', [ReportController::class, 'manage'])->name('user.reports.manage');

    Route::post('/reports', [ReportController::class, 'store'])->name('user.reports.store');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('user.reports.show');
    Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('user.reports.edit');
    Route::put('/reports/{report}', [ReportController::class, 'update'])->name('user.reports.update');
    Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('user.reports.destroy');
    Route::post('/reports/{report}/like', [ReportController::class, 'toggleLike'])->name('user.reports.like');
    Route::get('/{report}/view', [ReportController::class, 'view'])->name('user.reports.view');

    Route::post('/reports/{report}/comments', [CommentController::class, 'store'])->name('user.comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('user.comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('user.comments.destroy');
});

Route::middleware(['auth', 'verified', 'role:staff'])->group(function () {
    Route::get('/dashboard/staff/staff', [StaffDashboardController::class, 'index'])->name('dashboard.staff');
    Route::post('/staff/reports/{report}/status', [StaffDashboardController::class, 'updateStatus'])->name('staff.reports.updateStatus');

    Route::get('/staff/reports/export-all', [ExportReportController::class, 'exportAll'])->name('staff.reports.export.all');
    Route::get('/staff/reports/export/month', [ExportReportController::class, 'exportLastMonth'])->name('staff.reports.export.month');
Route::get('/staff/reports/export/week', [ExportReportController::class, 'exportLastWeek'])->name('staff.reports.export.week');
    Route::get('/staff/reports/{report}/export', [ExportReportController::class, 'exportSingle'])->name('staff.reports.export.single');

    Route::get('/staff/reports/{report}', [StaffDashboardController::class, 'show'])->name('staff.reports.show');
    Route::post('/staff/reports/{report}/progress', [StaffDashboardController::class, 'storeProgress'])->name('staff.reports.progress.store');
    Route::post('/staff/reports/{report}/complete', [StaffDashboardController::class, 'markAsCompleted'])->name('staff.reports.complete');
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
