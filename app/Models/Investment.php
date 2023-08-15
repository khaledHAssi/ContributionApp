<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;
    public function subscribes()
    {
        return $this->hasMany(Subscribe::class, 'investment_id')->withDefault();
    }
}
