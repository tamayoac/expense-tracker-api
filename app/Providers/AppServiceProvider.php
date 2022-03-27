<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\{ExpenseCategoryInterface, ExpenseInterface, PermissionInterface, RoleInterface, UserInterface};
use App\Repositories\{ExpenseCategoryRepository, ExpenseRepository, PermissionRepository, RoleRepository, UserRepository};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ExpenseCategoryInterface::class,  ExpenseCategoryRepository::class);
        $this->app->bind(ExpenseInterface::class,  ExpenseRepository::class);
        $this->app->bind(RoleInterface::class,  RoleRepository::class);
        $this->app->bind(UserInterface::class,  UserRepository::class);
        $this->app->bind(PermissionInterface::class,  PermissionRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') != 'local') {
            URL::forceScheme('https');
        }
    }
}
