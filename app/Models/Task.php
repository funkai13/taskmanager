<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'status_id', 'employee_id', 'title', 'description', 'created_by', 'modified_by'
    ];

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function comments()
    {
        return $this->hasMany(CommentTask::class);
    }
    
    use HasFactory;
}
