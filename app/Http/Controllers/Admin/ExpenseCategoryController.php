<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Interfaces\ExpenseCategoryInterface;
use App\Http\Requests\{StoreExpenseCategoryFormRequest, UpdateExpenseCategoryFormRequest};

class ExpenseCategoryController extends Controller
{
    public function __construct(ExpenseCategoryInterface $expenseCategory)
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
    public function selectcategory()
    {
        $expenseCategories = $this->expenseCategory->getAllSelect();

        return $this->successResponse($expenseCategories);
    }
}
