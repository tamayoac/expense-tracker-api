<?php

use App\Http\Controllers\Admin\{RoleController, ExpenseCategoryController, UserController, ExpenseController, PermissionController};
use App\Http\Controllers\{AuthController, DashboardController};
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

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::post('/', [RoleController::class, 'store']);
        Route::put('/{role}', [RoleController::class, 'update']);
        Route::patch('/{role}', [RoleController::class, 'update']);
        Route::delete('/{role}', [RoleController::class, 'destory']);
    });
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [ExpenseCategoryController::class, 'index']);
        Route::post('/', [ExpenseCategoryController::class, 'store']);
        Route::put('/{category}', [ExpenseCategoryController::class, 'update']);
        Route::patch('/{category}', [ExpenseCategoryController::class, 'update']);
        Route::delete('/{category}', [ExpenseCategoryController::class, 'destory']);
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::put('/{user}', [UserController::class, 'update']);
        Route::patch('/{user}', [UserController::class, 'update']);
        Route::delete('/{user}', [UserController::class, 'destory']);
    });

    Route::group(['prefix' => 'expenses'], function () {
        Route::get('/', [ExpenseController::class, 'index']);
        Route::post('/', [ExpenseController::class, 'store']);
        Route::put('/{expense}', [ExpenseController::class, 'update']);
        Route::patch('/{expense}', [ExpenseController::class, 'update']);
        Route::delete('/{expense}', [ExpenseController::class, 'destory']);
    });

    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', [PermissionController::class, 'index']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/userpermissions', [AuthController::class, 'userpermissions']);
    Route::get('/me', [AuthController::class, 'me']);
});
