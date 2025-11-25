<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@barroc.nl',
            'password' => Hash::make('password123'),
            'is_admin' => true,
            'department' => 'Management',
            'status' => 'active',
            'phone_num' => '+31 6 12345678',
            'last_active' => now(),
        ]);

        User::create([
            'name' => 'Sales Medewerker',
            'email' => 'sales@barroc.nl',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'department' => 'Sales',
            'status' => 'active',
            'phone_num' => '+31 6 23456789',
            'last_active' => now(),
        ]);

        User::create([
            'name' => 'Purchasing Medewerker',
            'email' => 'purchasing@barroc.nl',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'department' => 'Purchasing',
            'status' => 'active',
            'phone_num' => '+31 6 34567890',
            'last_active' => now(),
        ]);

        User::create([
            'name' => 'Finance Medewerker',
            'email' => 'finance@barroc.nl',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'department' => 'Finance',
            'status' => 'active',
            'phone_num' => '+31 6 45678901',
            'last_active' => now(),
        ]);

        User::create([
            'name' => 'Technician Medewerker',
            'email' => 'technician@barroc.nl',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'department' => 'Technician',
            'status' => 'active',
            'phone_num' => '+31 6 56789012',
            'last_active' => now(),
        ]);

        User::create([
            'name' => 'Planner Medewerker',
            'email' => 'planner@barroc.nl',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'department' => 'Planner',
            'status' => 'active',
            'phone_num' => '+31 6 67890123',
            'last_active' => now(),
        ]);

        User::factory()->count(30)->create();
    }
}
