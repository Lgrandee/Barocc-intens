<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\Product;
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
        $contract = Contract::factory()->create([
            'name_company_id' => $customer->id
        ]);

        // Attach 1-2 random products
        $productIds = Product::inRandomOrder()->take(rand(1, 2))->pluck('id')->toArray();
        $contract->products()->sync($productIds);
    });

    }
}
