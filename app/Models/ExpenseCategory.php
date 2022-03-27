<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

class ExpenseCategory extends BaseModel
{
    public function expense(): HasOne
    {
        return $this->hasOne(Expense::class);
    }
}
