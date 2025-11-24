<?php

namespace Database\Seeders;

use App\Models\Offerte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Offerte::factory()->count(50)->create();
    }
}
