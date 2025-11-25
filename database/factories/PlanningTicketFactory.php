<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlanningTicket>
 */
class PlanningTicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'catagory' => $this->faker->randomElement(['meeting', 'installation', 'service']),
            'feedback_id' => Feedback::inRandomOrder()->first()?->id,
            'location' => $this->faker->city(),
            'scheduled_time' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
            'user_id' => User::inRandomOrder()->first()?->id,
            'priority' => $this->faker->randomElement(['laag', 'medium', 'hoog', null]),
        ];
    }
}
