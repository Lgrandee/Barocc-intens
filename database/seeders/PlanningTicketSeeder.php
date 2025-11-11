<?php

namespace Database\Seeders;

use App\Models\PlanningTicket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanningTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PlanningTicket::factory(50)->create();
    }
}
