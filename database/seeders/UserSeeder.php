<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '03001234567',
            'address' => 'Islamabad, Pakistan',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Customer user
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'phone' => '03007654321',
            'address' => 'Rawalpindi, Pakistan',
            'password' => Hash::make('password'), // 🔑 default password
            'role' => 'customer',
        ]);
    }
}
