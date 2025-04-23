<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'manager') {
            $taskCount = Task::count();
            $employeeCount = User::where('role', 'employee')->count();
            $tasks = Task::with('assignee')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
            
            // Get unread notifications for task updates and comments
            $notifications = $user->unreadNotifications()
                ->whereIn('type', [
                    'App\Notifications\TaskStatusUpdated',
                    'App\Notifications\TaskCommentAdded'
                ])
                ->orderBy('created_at', 'desc')
                ->get();

            return view('dashboard.manager', compact('taskCount', 'employeeCount', 'tasks', 'notifications'));
        } else {
            $tasks = Task::where('assigned_to', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
            
            // Get unread notifications for task updates and comments
            $notifications = $user->unreadNotifications()
                ->whereIn('type', [
                    'App\Notifications\TaskStatusUpdated',
                    'App\Notifications\TaskCommentAdded'
                ])
                ->orderBy('created_at', 'desc')
                ->get();

            return view('dashboard.employee', compact('tasks', 'notifications'));
        }
    }
}

