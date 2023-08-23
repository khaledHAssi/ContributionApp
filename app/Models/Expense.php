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
    public function expense_field()
    {
        return $this->belongsTo(Expense_field::class , 'expenseField_id')->withDefault();
    }
}
