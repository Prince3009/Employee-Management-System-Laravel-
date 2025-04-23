<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            // Foreign key to users table for assigned_to
            $table->foreignId('assigned_to')->constrained('users')->onDelete('cascade');
            // Foreign key to users table for assigned_by
            $table->foreignId('assigned_by')->constrained('users')->onDelete('cascade');
            // Task status (pending, in_progress, completed)
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            // Due date
            $table->date('due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
