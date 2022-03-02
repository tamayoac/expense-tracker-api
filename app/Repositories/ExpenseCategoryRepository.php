<?php

namespace App\Repositories;

use App\Models\ExpenseCategory;

use App\Interfaces\ExpenseCategoryInterface;

class ExpenseCategoryRepository implements ExpenseCategoryInterface
{
    public function __construct(ExpenseCategory $expenseCategory)
    {
        $this->expenseCategory = $expenseCategory;
    }
    public function getAll()
    {
        return $this->expenseCategory->get();
    }
    public function getById($expenseCategory)
    {
        $expenseCategory = $this->expenseCategory->findOrFail($expenseCategory);
                   
        return $expenseCategory;
    }
    public function create(array $attributes)
    {   
        $expenseCategory = $this->expenseCategory->create([
            'display_name' => $attributes['display_name'],
            'description' => $attributes['description']
        ]);
        return $expenseCategory;
    }
    public function update(array $attributes, $expenseCategory)
    {
        $expenseCategory = $this->expenseCategory->findOrFail($expenseCategory);
        
        if(isset($expenseCategory)) {
            $expenseCategory->update($attributes);

            return $expenseCategory;
        }
        return $expenseCategory;
    }
    public function delete($expenseCategory)
    {
        $expenseCategory = $this->expenseCategory->findOrFail($expenseCategory);
        
        if(isset($expenseCategory)) {
            $expenseCategory->delete();
            return true;
        }
        return false;
    }


}