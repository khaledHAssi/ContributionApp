<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    public function subscribes()
    {
        return $this->hasMany(Subscribe::class , 'member_id');
    }
    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class , 'supervisor_id');
    }
}
