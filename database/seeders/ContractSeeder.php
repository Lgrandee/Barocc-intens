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

            // Attach 1-3 random products with random quantities
            $products = Product::inRandomOrder()->take(rand(1, 3))->get();
            $syncData = [];
            foreach ($products as $product) {
                $syncData[$product->id] = ['quantity' => rand(1, 5)];
            }
            $contract->products()->sync($syncData);
        });
    }
}
