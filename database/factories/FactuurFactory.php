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
        $invoiceDate = $this->faker->dateTimeBetween('-3 months', 'now');
        $paymentTermsDays = $this->faker->randomElement([7, 14, 30]);
        $dueDate = (clone $invoiceDate)->modify("+{$paymentTermsDays} days");

        // Determine status based on dates
        $isPastDue = $dueDate < now();
        $statuses = ['concept', 'verzonden', 'betaald'];
        if ($isPastDue) {
            $statuses[] = 'verlopen';
        }
        $status = $this->faker->randomElement($statuses);

        return [
            'name_company_id' => Customer::inRandomOrder()->first()?->id,
            'invoice_date' => $invoiceDate,
            'due_date' => $dueDate,
            'reference' => $this->faker->optional(0.6)->randomElement([
                'CONTRACT-2025-' . str_pad($this->faker->numberBetween(1, 50), 3, '0', STR_PAD_LEFT),
                'OFF-2025-' . str_pad($this->faker->numberBetween(1, 50), 3, '0', STR_PAD_LEFT),
                'PROJECT-' . $this->faker->numberBetween(1000, 9999),
            ]),
            'payment_method' => $this->faker->randomElement(['bank_transfer', 'ideal', 'creditcard', 'cash']),
            'description' => $this->faker->optional(0.7)->sentence(8),
            'notes' => $this->faker->optional(0.4)->sentence(12),
            'status' => $status,
            'sent_at' => in_array($status, ['verzonden', 'betaald', 'verlopen']) ? $invoiceDate : null,
            'paid_at' => $status === 'betaald' ? $this->faker->dateTimeBetween($invoiceDate, $dueDate) : null,
        ];
    }
}
