<?php

use App\Http\Controllers\Admin\{RoleController, ExpenseCategoryController, UserController, PermissionController};
use App\Http\Controllers\Client\{AuthController};
use App\Http\Controllers\Client\{DashboardController, ExpenseController};
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
    Route::group(['prefix' => 'expenses'], function () {
        Route::get('/', [ExpenseController::class, 'index']);
        Route::post('/', [ExpenseController::class, 'store']);
        Route::put('/{expense}', [ExpenseController::class, 'update']);
        Route::patch('/{expense}', [ExpenseController::class, 'update']);
        Route::delete('/{expense}', [ExpenseController::class, 'destory']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/recent-expense', [ExpenseController::class, 'getRecentExpense']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/select-categories', [ExpenseCategoryController::class, 'selectcategories']);
    Route::post('/change-password', [AuthController::class, 'passwordReset']);
    Route::get('/me', [AuthController::class, 'me']);
});
