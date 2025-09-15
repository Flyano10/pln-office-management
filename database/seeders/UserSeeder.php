<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        User::create([
            'name' => 'Admin PLN',
            'email' => 'admin@pln.co.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '08123456789',
            'is_active' => true
        ]);

        // Create Regular User
        User::create([
            'name' => 'User PLN',
            'email' => 'user@pln.co.id',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '08987654321',
            'is_active' => true
        ]);
    }
}
