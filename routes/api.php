<?php

use App\Http\Controllers\Admin\{RoleController, ExpenseCategoryController, UserController, ExpenseController};
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth:api', 'auth-gate'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::get('/roles/{role}', [RoleController::class, 'show']);
    Route::put('/roles/{role}', [RoleController::class, 'update']);
    Route::patch('/roles/{role}', [RoleController::class, 'update']);
    Route::delete('/roles/{role}', [RoleController::class, 'destory']);
    
    Route::get('/categories', [ExpenseCategoryController::class, 'index']);
    Route::post('/categories', [ExpenseCategoryController::class, 'store']);
    Route::get('/categories/{category}', [ExpenseCategoryController::class, 'show']);
    Route::put('/categories/{category}', [ExpenseCategoryController::class, 'update']);
    Route::patch('/categories/{category}', [ExpenseCategoryController::class, 'update']);
    Route::delete('/categories/{category}', [ExpenseCategoryController::class, 'destory']);
    
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::patch('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destory']);
    
    Route::get('/expenses', [ExpenseController::class, 'index']);
    Route::post('/expenses', [ExpenseController::class, 'store']);
    Route::get('/expenses/{expense}', [ExpenseController::class, 'show']);
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update']);
    Route::patch('/expenses/{expense}', [ExpenseController::class, 'update']);
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destory']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/userpermissions', [AuthController::class, 'userpermissions']);
    Route::get('/me', [AuthController::class, 'me']);
});