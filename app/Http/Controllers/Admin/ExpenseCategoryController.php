<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreExpenseCategoryFormRequest, UpdateExpenseCategoryFormRequest};
use App\Repositories\ExpenseCategoryRepository;
use Illuminate\Http\Response;

class ExpenseCategoryController extends Controller
{
    public function __construct(ExpenseCategoryRepository $expenseCategory)
    {
        $this->expenseCategory = $expenseCategory;
    }
    public function index()
    {
        $expenseCategorys = $this->expenseCategory->getAll();

        return $this->successResponse($expenseCategorys);
    }
    public function store(StoreExpenseCategoryFormRequest $request)
    {
        $validated = $request->validated();

        $expenseCategory = $this->expenseCategory->create($validated);

        return $this->successResponse($expenseCategory, Response::HTTP_CREATED);
    }
    public function show($expenseCategory)
    {   
        return $this->successResponse($this->expenseCategory->getById($expenseCategory));
    }
    public function update(UpdateExpenseCategoryFormRequest $request, $expenseCategory)
    {   
        $validated = $request->validated();
       
        $expenseCategory = $this->expenseCategory->update($validated, $expenseCategory);

        return $this->successResponse($expenseCategory);
    }
    public function destory($expenseCategory) 
    {
        $expenseCategory = $this->expenseCategory->delete($expenseCategory);

        return $this->successResponse($expenseCategory);
    }
}
