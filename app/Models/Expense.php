<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    public function investment()
    {
        return $this->belongsTo(Investment::class , 'investment_id')->withDefault();
    }
}
