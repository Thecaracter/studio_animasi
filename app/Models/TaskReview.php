<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_submission_id',
        'reviewed_by_id',
        'feedback',
        'status',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function submission()
    {
        return $this->belongsTo(TaskSubmission::class, 'task_submission_id');
    }

    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by_id');
    }
}
