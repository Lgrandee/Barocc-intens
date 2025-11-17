<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Offerte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::all()->each(function ($customer) {
        Offerte::factory()->create([
        'name_company_id' => $customer->id ]);
    });

    }
}
