<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
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

        foreach ($roles as $role) {
            foreach ($permissions as $permission) {
                if (Str::snake(ucwords($role->display_name)) == 'super_admin') {
                    $role->permissions()->attach($permission->id);
                }
            }
        }
    }
}
