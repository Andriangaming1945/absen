<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['task_classroom', 'user'];

    public function user(){
        return $this->belongsTo(User::class, 'user', 'no_id');
    }

    public function task_classroom() {
        return $this->hasMany(TaskClassroom::class);
    }
}
