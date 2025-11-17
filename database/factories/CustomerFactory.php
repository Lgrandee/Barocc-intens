<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Factuur;
use App\Models\Offerte;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_company' => $this->faker->company(),
            'contact_person' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'bkr_number' => $this->faker->bothify('BKR-#######'),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'zipcode' => $this->faker->postcode(),
            'bkr_status' => $this->faker->randomElement(['approved', 'denied', 'pending', 'unknown']),
            'offerte_id' => Offerte::inRandomOrder()->first()?->id,
            'factuur_id' => Factuur::inRandomOrder()->first()?->id,
            'contract_id' => Contract::inRandomOrder()->first()?->id,
        ];
    }
}
