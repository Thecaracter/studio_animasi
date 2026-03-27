<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'submitted_by_id',
        'notes',
        'drive_link',
        'status',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by_id');
    }

    public function review()
    {
        return $this->hasOne(TaskReview::class);
    }
}
