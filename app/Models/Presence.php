<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['user', 'attadance_time', 'working_day'];

    public function user() {
        return $this->belongsTo(User::class, 'no_id', 'no_id');
    }

    public function attadance_time(){
        return $this->hasOne(AttadanceTime::class);
    }

    public function working_day(){
        return $this->hasOne(AttadanceTime::class);
    }
}
