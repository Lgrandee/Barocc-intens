<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Product;

class ContractFactory extends Factory
{
    protected $model = Contract::class;

    public function definition(): array
    {
        return [
            'name_company_id' => Customer::inRandomOrder()->first()?->id,
            'product_id' => Product::inRandomOrder()->first()?->id,
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'status' => $this->faker->randomElement(['active', 'inactive', 'pending']),
        ];
    }
}
