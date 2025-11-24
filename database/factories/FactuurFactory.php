<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Factuur;
use App\Models\Customer;
use App\Models\Product;

class FactuurFactory extends Factory
{
    protected $model = Factuur::class;

    public function definition(): array
    {
        return [
            'name_company_id' => Customer::inRandomOrder()->first()?->id,
            'product_id' => Product::inRandomOrder()->first()?->id,
            'invoice_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => $this->faker->randomElement(['paid', 'unpaid', 'overdue']),
        ];
    }
}
