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

        if($user) {
            $roles = Role::with('permissions')->get();

            $permissionArray = [];

            foreach($roles as $role) {
                foreach($role->permissions as $permission) {
                    $permissionArray[$permission->title][] = $role->display_name;
                }
            }
            foreach($permissionArray as $title => $roles) {
                Gate::define($title, function(\App\Models\User $user) use ($roles){
                    return count(array_intersect($user->roles->pluck('display_name')->toArray(),  $roles));
                });
            }          
        }
        return $next($request);
    }
}
