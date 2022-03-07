<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Expense;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $expenses = Expense::where('user_id', '=', $user->id)
            ->join('expense_categories', 'expense_categories.id', '=', 'expenses.category_id')
            ->selectRaw("expense_categories.display_name as category, SUM(amount) as total_amount")
            ->groupBy('expense_categories.id')
            ->get()->toArray();

        return $this->validResponse($expenses);
    }
}
