<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskClassroom extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['classroom'];

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
}
