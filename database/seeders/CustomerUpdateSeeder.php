<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Offerte;
use App\Models\Factuur;
use App\Models\Contract;

class CustomerUpdateSeeder extends Seeder
{
    public function run(): void
    {
        Customer::all()->each(function ($customer) {
            $offerte = Offerte::where('name_company_id', $customer->id)->first();
            $factuur = Factuur::where('name_company_id', $customer->id)->first();
            $contract = Contract::where('name_company_id', $customer->id)->first();

            $customer->update([
                'offerte_id' => $offerte->id,
                'factuur_id' => $factuur->id,
                'contract_id' => $contract->id,
            ]);
        });
    }
}
