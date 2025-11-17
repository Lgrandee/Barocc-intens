<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Factuur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FactuurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::all()->each(function ($customer) {
        Factuur::factory()->create([
        'name_company_id' => $customer->id
        ]);
    });

    }
}
