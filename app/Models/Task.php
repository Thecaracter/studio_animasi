<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'assigned_by_id',
        'assigned_to_id',
        'title',
        'description',
        'status',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function submissions()
    {
        return $this->hasMany(TaskSubmission::class);
    }

    public function performanceLog()
    {
        return $this->hasOne(PerformanceLog::class);
    }
}
