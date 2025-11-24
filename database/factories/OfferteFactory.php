<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offerte>
 */
class OfferteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_company_id' => Customer::inRandomOrder()->first()?->id,
            'product_id' => Product::inRandomOrder()->first()?->id,
            'status' => $this->faker->randomElement(['accepted', 'rejected', 'pending']),
        ];
    }
}
