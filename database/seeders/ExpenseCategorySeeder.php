<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpenseCategory::insert([
            [
                'id' => 1,
                'display_name' => 'Travel',
                'description' => 'Travel',
            ],
            [
                'id' => 2,
                'display_name' => 'Food',
                'description' => 'Food',
            ]
        ]);
    }
}
