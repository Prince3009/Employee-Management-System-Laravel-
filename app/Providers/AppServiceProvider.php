<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Console\Scheduling\Schedule;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Artisan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Schedule $schedule): void
    {
        // Register the middleware for role-based access
        Route::middleware('role:manager')->group(function () {
            // Define routes that should only be accessed by managers
            Route::resource('tasks', TaskController::class);
        });

        Route::middleware('role:employee')->group(function () {
            // Define routes that should only be accessed by employees
            Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
            Route::post('/tasks/{task}/updates', [TaskUpdateController::class, 'store'])->name('task.update');
        });

        // Schedule the Task Reminders command to run daily
        $schedule->command('tasks:send-reminders')->daily(); // Adjust timing as needed
    }
}
