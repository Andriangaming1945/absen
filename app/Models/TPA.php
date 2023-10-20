<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPA extends Model
{
    use HasFactory;

    protected $table = 'TPA';
    protected $fillable = [
        "no_id",
        "name",
        "username",
        "phone",
        "address",
        "employment_status",
        "status",
        "password",

    ];
}
