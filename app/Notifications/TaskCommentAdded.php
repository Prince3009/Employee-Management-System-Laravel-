<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Task;
use App\Models\User;

class TaskCommentAdded extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;
    protected $user;
    protected $comment;

    public function __construct(Task $task, User $user, $comment)
    {
        $this->task = $task;
        $this->user = $user;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'user_name' => $this->user->name,
            'comment_text' => $this->comment
        ];
    }
} 