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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
