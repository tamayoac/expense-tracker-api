<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreExpenseFormRequest, UpdateExpenseFormRequest};
use App\Interfaces\ExpenseInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{
    public function __construct(ExpenseInterface $expense)
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
    public function update(UpdateExpenseFormRequest $request, $user)
    {
        $validated = $request->validated();

        $expense = $this->expense->update($validated, $user);

        return $this->successResponse($expense);
    }
    public function destory($expense)
    {
        abort_if(Gate::denies('delete_user'), Response::HTTP_FORBIDDEN);

        $expense = $this->expense->delete($expense);

        return $this->successResponse($expense);
    }
    public function getRecentExpense()
    {
        $user = auth()->user();

        $expense = $this->expense->getRecent($user);

        return $this->successResponse($expense);
    }
}
