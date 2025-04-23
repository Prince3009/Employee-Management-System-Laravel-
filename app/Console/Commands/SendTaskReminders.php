<?php

namespace App\Console\Commands;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskReminder; // Add this if you create the reminder mail

class SendTaskReminders extends Command
{
    protected $signature = 'tasks:send-reminders';
    protected $description = 'Send reminder notifications for overdue tasks';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get overdue tasks
        $tasks = Task::where('due_date', '<', Carbon::now())
                     ->where('status', '!=', 'completed')
                     ->get();

        foreach ($tasks as $task) {
            // Send email notification (you will need to create this email)
            $user = $task->assignedUser; // Assuming the task has an assigned user

            // Example email (you can customize this part)
            Mail::to($user->email)->send(new TaskReminder($task));

            $this->info("Reminder sent for task: {$task->title} to {$user->email}");
        }
    }
}
