<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseFormRequest;
use App\Repositories\ExpenseRepository;
use Illuminate\Http\Response;

class ExpenseController extends Controller
{
    public function __construct(ExpenseRepository $expense)
    {
        $this->expense = $expense;
    }
    public function index()
    {
        $user = auth()->user();
        
        $expense = $this->expense->getAll($user);

        return $this->successResponse($expense);
    }
    public function store(StoreExpenseFormRequest $request)
    {
        $user = auth()->user();

        $validated = $request->validated();
       
        $expense = $this->expense->create($validated, $user);

        return $this->successResponse($expense, Response::HTTP_CREATED);
    }
}
