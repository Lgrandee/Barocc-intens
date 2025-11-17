<?php

namespace Database\Factories;

use App\Models\OrderLogistic;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderLogisticFactory extends Factory
{
    protected $model = OrderLogistic::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()?->id,
            'amount' => $this->faker->numberBetween(1, 20),
            'price' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
