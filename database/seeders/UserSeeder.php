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
            'email' => 'admin@barroc.com',
            'password' => Hash::make('password123'),
            'is_admin' => true,
            'department' => 'Management',
        ]);

        User::create([
            'name' => 'Sales Medewerker',
            'email' => 'sales@barroc.nl',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'department' => 'Sales',
        ]);

        User::create([
            'name' => 'Purchasing Medewerker',
            'email' => 'purchasing@barroc.nl',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'department' => 'Purchasing',
        ]);

        User::create([
            'name' => 'Finance Medewerker',
            'email' => 'finance@barroc.nl',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'department' => 'Finance',
        ]);

        User::create([
            'name' => 'Technician Medewerker',
            'email' => 'technician@barroc.nl',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'department' => 'Technician',
        ]);

        User::create([
            'name' => 'Planner Medewerker',
            'email' => 'planner@barroc.nl',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'department' => 'Planner',
        ]);
    }
}
