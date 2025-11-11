<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::factory(20)->create([
            'offerte_id' => null,
            'factuur_id' => null,
            'contract_id' => null,
        ]);
    }
}
