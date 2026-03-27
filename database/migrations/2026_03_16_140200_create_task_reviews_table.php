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
        Schema::create('task_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_submission_id')->constrained('task_submissions')->onDelete('cascade');
            $table->foreignId('reviewed_by_id')->constrained('users')->onDelete('cascade'); // Reviewer
            $table->text('feedback')->nullable();
            $table->enum('status', ['approved', 'rejected'])->default('approved');
            $table->timestamp('reviewed_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_reviews');
    }
};
