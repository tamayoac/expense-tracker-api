<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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

        $categories = $this->expenseCategory->getAll();

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }
    public function create()
    {
        abort_if(Gate::denies('create_category'), Response::HTTP_FORBIDDEN);

        return view('admin.categories.create');
    }
    public function store(StoreExpenseCategoryFormRequest $request)
    {
        $validated = $request->validated();

        $this->expenseCategory->create($validated);

        return redirect()->route('categories.index');
    }
    public function update(UpdateExpenseCategoryFormRequest $request, $expenseCategory)
    {
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
    public function selectcategories()
    {
        $expenseCategories = $this->expenseCategory->getAllSelect();

        return $this->successResponse($expenseCategories);
    }
}
