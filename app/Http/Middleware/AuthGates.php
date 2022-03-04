<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class AuthGates
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // $permissions = Permission::all();

        // foreach($permissions as $permission) {
        //     Gate::define($permission->title, function($user) use ($permission){
        //         return $user->hasPermissionTo($permission->title);
        //     });
        // }


        if($user) {
            $roles = Role::with('permissions')->get();

            $permissionArray = [];

            foreach($roles as $role) {
                foreach($role->permissions as $permission) {
                    $permissionArray[$permission->title][] = $role->name;
                }
            }
            foreach($permissionArray as $title => $roles) {
                Gate::define($title, function(\App\Models\User $user) use ($roles){
                    return count(array_intersect($user->roles->pluck('name')->toArray(),  $roles));
                });
            }          
        }
        return $next($request);
    }
}
