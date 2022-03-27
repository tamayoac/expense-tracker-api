<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AuthController, DashboardController, RoleController, ExpenseCategoryController, UserController, PermissionController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::middleware(['auth', 'is-admin', 'auth-gate'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::post('/', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::get('/{role}', [RoleController::class, 'show'])->name('roles.show');
        Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::patch('/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/{role}', [RoleController::class, 'destory'])->name('roles.destory');
    });
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [ExpenseCategoryController::class, 'index'])->name('categories.index');
        Route::post('/', [ExpenseCategoryController::class, 'store'])->name('categories.store');
        Route::get('/create', [ExpenseCategoryController::class, 'create'])->name('categories.create');
        Route::put('/{category}', [ExpenseCategoryController::class, 'update']);
        Route::patch('/{category}', [ExpenseCategoryController::class, 'update']);
        Route::delete('/{category}', [ExpenseCategoryController::class, 'destory']);
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::patch('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destory'])->name('users.destory');
    });

    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
    });

    Route::get('/select-categories', [ExpenseCategoryController::class, 'selectcategories']);
    Route::get('/select-roles', [RoleController::class, 'selectroles']);

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
