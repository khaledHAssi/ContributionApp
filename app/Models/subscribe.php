<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;
    public function members()
    {
        return $this->belongsTo(Member::class, 'member_id')->withDefault();
    }
    public function investments()
    {
        return $this->belongsTo(Investment::class, 'investment_id')->withDefault();
    }
}
