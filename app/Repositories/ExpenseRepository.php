<?php

namespace App\Repositories;

use App\Models\Expense;

use App\Interfaces\ExpenseInterface;
use App\Models\ExpenseCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Helpers\CollectionHelper;

class ExpenseRepository implements ExpenseInterface
{
    public function __construct(Expense $expense, ExpenseCategory $expenseCategory)
    {
        $this->expense = $expense;
        $this->expenseCategory = $expenseCategory;
    }

    public function getAll($user)
    {

        $expensesCollection = collect();

        $page = 10;

        foreach ($user->expenses  as $expense) {

            $expensesCollection->push([
                "id" => $expense->id,
                "category" => $expense->category->display_name,
                "amount" => $expense->amount,
                "date" => Carbon::parse($expense->date)->format('Y-m-d'),
                "created_at" => Carbon::parse($expense->created_at)->format('Y-m-d')
            ]);
        }

        return CollectionHelper::paginate($expensesCollection, $page);
    }
    public function getById($expense)
    {
        $expense = $this->expense->findOrFail($expense);

        return $expense;
    }
    public function create(array $attributes, $user)
    {
        $category = $this->expenseCategory->findOrFail($attributes['category']);

        try {
            DB::beginTransaction();

            $expense = $this->expense->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'description' => $attributes['description'],
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

        $category = $this->expenseCategory->findOrFail($attributes['category']);

        if (isset($expense)) {
            $expense->update([
                'category_id' => $category->id,
                'description' => $attributes['description'],
                'amount' => $attributes['amount'],
                'date' => $attributes['date']
            ]);

            return $expense;
        }
        return $expense;
    }
    public function delete($expense)
    {
        $expense = $this->expense->findOrFail($expense);

        if (isset($expense)) {
            $expense->delete();
            return true;
        }
        return false;
    }
    public function getRecent($user)
    {

        $expenses = collect();

        $recents = $user->expenses()->orderBy('id', 'DESC')->limit(5)->get();

        foreach ($recents  as $recent) {

            $expenses->push([
                "id" => $recent->id,
                "category" => $recent->category->display_name,
                "amount" => $recent->amount,
                "date" => Carbon::parse($recent->date)->format('Y-m-d'),
            ]);
        }

        return $expenses;
    }
}
