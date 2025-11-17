<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::all()->each(function ($customer) {
        Contract::factory()->create([
        'name_company_id' => $customer->id
        ]);
    });

    }
}
