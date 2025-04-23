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
        Schema::create('task_updates', function (Blueprint $table) {
            $table->id();
            // Foreign key to the tasks table
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            // Foreign key to the users table (user who added the update)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Update text (what was changed/updated)
            $table->text('update_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_updates');
    }
};
