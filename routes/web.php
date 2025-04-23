<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskUpdateController;
use App\Http\Controllers\NotificationController; // Add this import
use App\Http\Controllers\CommentController; // Add the CommentController import
use Illuminate\Support\Facades\Route;

// Default welcome page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (uses DashboardController)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Manager-only task routes
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::resource('tasks', TaskController::class);
});

// Employee-only routes
Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::post('/tasks/{task}/updates', [TaskUpdateController::class, 'store'])->name('task.update');
});

// Comment routes (added for comment handling)
Route::post('/tasks/{task}/comments', [CommentController::class, 'store'])->name('comments.store');

// Auth routes
require __DIR__.'/auth.php';

// Mark notifications as read route
Route::post('/notifications/{notificationId}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
