<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::get();

        $permissions = Permission::get();

        foreach($roles as $role) {
            foreach($permissions as $permission) {
                if($role->name === "admin") {
                    $role->permissions()->attach($permission->id);
                } 
                if($role->name === "client") {
                    if($permission->type == 'expenses') 
                    {
                        $role->permissions()->attach($permission->id);
                    }
                }
            }
        }
    }
}