<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @mixin HasRoles
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Task relationships
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to_id');
    }

    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'assigned_by_id');
    }

    public function taskSubmissions()
    {
        return $this->hasMany(TaskSubmission::class, 'submitted_by_id');
    }

    public function reviews()
    {
        return $this->hasMany(TaskReview::class, 'reviewed_by_id');
    }

    public function performanceLogs()
    {
        return $this->hasMany(PerformanceLog::class);
    }
}
