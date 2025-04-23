<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Reminder</title>
</head>
<body>
    <h1>Reminder: Overdue Task</h1>
    
    <p>Hello {{ $user->name }},</p>

    <p>This is a reminder that the task <strong>{{ $task->title }}</strong> is overdue. The due date was {{ $task->due_date->format('d M Y') }}.</p>
    
    <p><strong>Description:</strong> {{ $task->description }}</p>

    <p>Please take necessary action to complete the task as soon as possible.</p>
    
    <p>Best regards,</p>
    <p>Your Task Management System</p>
</body>
</html>
