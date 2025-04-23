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

        if ($user->isManager()) {
            $taskCount = Task::where('assigned_by', $user->id)->count();
            $employeeCount = User::where('role', 'employee')->count();
            $tasks = Task::where('assigned_by', $user->id)
                        ->with('assignee')
                        ->latest()
                        ->take(5)
                        ->get();

            return view('dashboard.manager', compact('taskCount', 'employeeCount', 'tasks'));
        } else {
            $assignedTasks = Task::where('assigned_to', $user->id)->get();
            $completed = $assignedTasks->where('status', 'completed')->count();
            $pending = $assignedTasks->where('status', 'pending')->count();

            return view('dashboard.employee', compact('assignedTasks', 'completed', 'pending'));
        }
    }
}

