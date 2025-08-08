<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [[
            'name' => 'Mostafa Alaa',
            'email' => 'mostafa@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 'admin',
        ] , [
            'name' => 'Mohamed Alaa',
            'email' => 'mohamed@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 'seeker',
        ], 
        [
            'name' => 'Mahmoud Alaa',
            'email' => 'mahmoud@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 'company',
        ]
    ];

        foreach ($users as $user) {
            User::create($user);
        }

        User::factory()->count(10)->create();
    }
}
