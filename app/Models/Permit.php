<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['user', 'information_permit', 'status_permit'];

    protected $cast = ['user', 'get-permit', 'approve-permit'];

    
    public function user(){
        return $this->belongsTo(User::class, 'no_id', 'no_id');
    }

    public function information_permit(){
        return $this->belongsTo(InformationPermit::class);
    }

    public function status_permit(){
        return $this->belongsTo(InformationPermit::class);
    }
}
