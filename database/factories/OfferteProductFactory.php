<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OfferteProduct;
use App\Models\Offerte;
use App\Models\Product;

class OfferteProductFactory extends Factory
{
    protected $model = OfferteProduct::class;

    public function definition(): array
    {
        return [
            'offerte_id' => Offerte::inRandomOrder()->first()?->id,
            'product_id' => Product::inRandomOrder()->first()?->id,
        ];
    }
}
