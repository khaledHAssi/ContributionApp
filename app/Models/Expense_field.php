<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense_field extends Model
{
    use HasFactory;

    public function expenses()
    {
        return $this->hasMany(Expense::class ,  'expenseField_id');
    }
}
