<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ])->assignRole('super_admin','admin','writer');

        User::create([
            'name' => 'Mochammad Faiz Adli', 
            'email' => 'faizadli9912@gmail.com',
            'password' => bcrypt('fas321')
        ])->assignRole('writer');

    }
}
