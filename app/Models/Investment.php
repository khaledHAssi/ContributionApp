<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;
    public function subscribers()
    {
        return $this->hasMany(Subscribe::class ,  'investment_id');
    }
    public function expenses()
    {
        return $this->hasMany(Expense::class ,  'investment_id');
    }
}
