<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;
    public function members()
    {
        return $this->hasMany(Member::class, 'supervisor_id')->withDefault();
    }
}
