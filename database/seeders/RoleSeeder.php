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
                'display_name' => 'admin',
                'description' => 'Admin',
            ],
            [
                'id' => 2,
                'display_name' => 'client',
                'description' => 'Client',
            ]
        ]);       
    }
}
