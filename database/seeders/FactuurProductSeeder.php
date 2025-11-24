<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Factuur;
use App\Models\Product;

class FactuurProductSeeder extends Seeder
{
    public function run(): void
    {
        $facturen = Factuur::all();

        foreach ($facturen as $factuur) {
            // Willekeurig aantal producten (1-5) per factuur
            $numberOfProducts = rand(1, 5);
            $products = Product::inRandomOrder()->limit($numberOfProducts)->get();

            foreach ($products as $product) {
                $factuur->products()->attach($product->id, [
                    'quantity' => rand(1, 10)
                ]);
            }
        }
    }
}
