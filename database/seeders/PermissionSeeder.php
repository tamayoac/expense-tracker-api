<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::PERMISSION_LIST;

    
        
        foreach($permissions as $key => $value) {
            foreach($value as $permission) {
                Permission::create([
                    'type' => $key,
                    'title' => $permission,
                ]);
            }
         
        }
    }
}
