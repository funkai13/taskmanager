<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentTask extends Model
{
    protected $fillable = [
        'task_id', 'comment', 'created_by', 'modified_by', 'active'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    
    use HasFactory;
}
