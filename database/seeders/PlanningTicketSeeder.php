<?php

namespace Database\Seeders;

use App\Models\PlanningTicket;
use App\Models\User;
use App\Models\Customer;
use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanningTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get technicians
        $technicians = User::where('department', 'Technician')->get();
        $customers = Customer::all();
        $products = Product::all();

        if ($technicians->isEmpty() || $customers->isEmpty()) {
            $this->command->warn('No technicians or customers found. Skipping PlanningTicket seeding.');
            return;
        }

        // Create specific maintenance tasks for each technician
        foreach ($technicians as $technician) {
            // Create some past completed tasks (3 voltooid, 2 te laat)
            for ($i = 0; $i < 5; $i++) {
                $customer = $customers->random();
                $daysAgo = rand(10, 60);
                $isCompleted = $i < 3; // First 3 are completed

                // Create feedback for this task
                $feedback = Feedback::create([
                    'customer_id' => $customer->id,
                    'employee_id' => $technician->id,
                    'description' => 'Filter vervanging en systeem check',
                    'feedback' => $isCompleted ? 'Onderhoud succesvol uitgevoerd. Alle filters vervangen en systeem gecontroleerd.' : null,
                ]);

                // Attach 1-3 random products to this feedback
                if ($products->isNotEmpty()) {
                    $selectedProducts = $products->random(rand(1, min(3, $products->count())));
                    foreach ($selectedProducts as $product) {
                        $feedback->products()->attach($product->id, [
                            'quantity' => rand(1, 2)
                        ]);
                    }
                }

                PlanningTicket::create([
                    'catagory' => 'service',
                    'feedback_id' => $feedback->id,
                    'location' => $customer->address ?? fake()->city(),
                    'scheduled_time' => now()->subDays($daysAgo),
                    'user_id' => $technician->id,
                    'status' => $isCompleted ? 'voltooid' : 'te_laat',
                    'priority' => fake()->randomElement(['laag', 'medium', 'hoog', null]),
                    'used_materials' => $isCompleted ? '2x Filter type A, 1x Koelmiddel' : null,
                ]);
            }

            // Create upcoming maintenance tasks
            for ($i = 0; $i < 8; $i++) {
                $customer = $customers->random();

                $feedback = Feedback::create([
                    'customer_id' => $customer->id,
                    'employee_id' => $technician->id,
                    'description' => fake()->randomElement([
                        'Jaarlijks onderhoud',
                        'Filter vervanging',
                        'Systeem inspectie',
                        'Preventief onderhoud',
                        'Halfjaarlijkse controle'
                    ]),
                ]);

                // Attach 1-3 random products to this feedback
                if ($products->isNotEmpty()) {
                    $selectedProducts = $products->random(rand(1, min(3, $products->count())));
                    foreach ($selectedProducts as $product) {
                        $feedback->products()->attach($product->id, [
                            'quantity' => rand(1, 2)
                        ]);
                    }
                }

                PlanningTicket::create([
                    'catagory' => 'service',
                    'feedback_id' => $feedback->id,
                    'location' => $customer->address ?? fake()->city(),
                    'scheduled_time' => now()->addDays(rand(1, 90)),
                    'user_id' => $technician->id,
                    'priority' => fake()->randomElement(['laag', 'medium', 'hoog', null]),
                ]);
            }
        }

        // Create some additional random planning tickets (meetings, installations)
        PlanningTicket::factory(20)->create();
    }
}
