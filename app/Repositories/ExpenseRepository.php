<?php

namespace App\Repositories;

use App\Models\Expense;

use App\Interfaces\ExpenseInterface;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\DB;

class ExpenseRepository implements ExpenseInterface
{
    public function __construct(Expense $expense, ExpenseCategory $expenseCategory)
    {
        $this->expense = $expense;
        $this->expenseCategory = $expenseCategory;
    }

    public function getAll($user)
    {
        return $user->expenses;
    }
    public function getById($expense)
    {
        $expense = $this->expense->findOrFail($expense);
                   
        return $expense;
    }
    public function create(array $attributes, $user)
    {   
        $category = $this->expenseCategory->findOrFail($attributes['category_id']);
        
        try {
            DB::beginTransaction();

            $expense = $this->expense->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'amount' => $attributes['amount'],
                'date' => $attributes['date']
            ]);
          
            DB::commit();

            return $expense;
        } catch (\Exception $e) {
            DB::rollback();
        }

        return null;
     
      
    }
    public function update(array $attributes, $expense)
    {
        $expense = $this->expense->findOrFail($expense);
        
        if(isset($expense)) {
            $expense->update($attributes);

            return $expense;
        }
        return $expense;
    }
    public function delete($expense)
    {
        $expense = $this->expense->findOrFail($expense);
        
        if(isset($expense)) {
            $expense->delete();
            return true;
        }
        return false;
    }
}