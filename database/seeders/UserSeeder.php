<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => "red@yamato.com",
            'password' => Hash::make("password123"),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ])->tap(function ($user) {
            $user->profile()->create([
                'first_name' => 'Alfred',
                'last_name' => 'Tamayo',
                'mobile' => '09295241537'
            ]);

            $user->roles()->attach(1);
        });

        User::create([
            'email' => "juandelacruz@gmail.com",
            'password' => Hash::make("password123"),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ])->tap(function ($user) {
            $user->profile()->create([
                'first_name' => 'Juan',
                'last_name' => 'Dela Cruz',
                'mobile' => '0934244291'
            ]);

            $user->roles()->attach(2);
        });
    }
}
