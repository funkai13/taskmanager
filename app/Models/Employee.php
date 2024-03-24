<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id', 'name', 'code', 'created_by', 'modified_by', 'active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    use HasFactory;
}
