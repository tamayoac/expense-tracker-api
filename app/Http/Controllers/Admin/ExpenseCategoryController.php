<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreExpenseCategoryFormRequest, UpdateExpenseCategoryFormRequest};
use App\Repositories\ExpenseCategoryRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ExpenseCategoryController extends Controller
{
    public function __construct(ExpenseCategoryRepository $expenseCategory)
    {
        $this->expenseCategory = $expenseCategory;
    }
    public function index()
    {
        abort_if(Gate::denies('view_category'), Response::HTTP_FORBIDDEN);
        
        $expenseCategorys = $this->expenseCategory->getAll();

        return $this->successResponse($expenseCategorys);
    }
    public function store(StoreExpenseCategoryFormRequest $request)
    {
        abort_if(Gate::denies('create_category'), Response::HTTP_FORBIDDEN);

        $validated = $request->validated();

        $expenseCategory = $this->expenseCategory->create($validated);

        return $this->successResponse($expenseCategory, Response::HTTP_CREATED);
    }
    public function show($expenseCategory)
    {   
        abort_if(Gate::denies('view_category'), Response::HTTP_FORBIDDEN);

        return $this->successResponse($this->expenseCategory->getById($expenseCategory));
    }
    public function update(UpdateExpenseCategoryFormRequest $request, $expenseCategory)
    {   
        abort_if(Gate::denies('update_category'), Response::HTTP_FORBIDDEN);

        $validated = $request->validated();
       
        $expenseCategory = $this->expenseCategory->update($validated, $expenseCategory);

        return $this->successResponse($expenseCategory);
    }
    public function destory($expenseCategory) 
    {
        abort_if(Gate::denies('delete_category'), Response::HTTP_FORBIDDEN);

        $expenseCategory = $this->expenseCategory->delete($expenseCategory);

        return $this->successResponse($expenseCategory);
    }
}
