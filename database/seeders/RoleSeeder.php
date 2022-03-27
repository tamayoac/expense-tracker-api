<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'id' => 1,
                'display_name' => 'Super Admin',
                'description' => 'Super Admin',
            ],
            [
                'id' => 2,
                'display_name' => 'Admin',
                'description' => 'Admin',
            ],
            [
                'id' => 3,
                'display_name' => 'Client',
                'description' => 'Client',
            ]
        ]);
    }
}
