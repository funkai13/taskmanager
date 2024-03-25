<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $fillable = [
        'name', 'description', 'created_by', 'created_at', 'modified_by', 'modified_at', 'active'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class,'status_id');
    }
    
    use HasFactory;
}
