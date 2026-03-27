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
            $table->foreignId('assigned_by_id')->constrained('users')->onDelete('cascade'); // Admin yang assign
            $table->foreignId('assigned_to_id')->constrained('users')->onDelete('cascade'); // Editor yang dikerjain
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['pending', 'in_progress', 'submitted', 'approved', 'rejected'])->default('pending');
            $table->timestamp('due_date');
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
