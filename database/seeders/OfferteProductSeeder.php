<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OfferteProduct;

class OfferteProductSeeder extends Seeder
{
    public function run(): void
    {
        // Maak bijvoorbeeld 50 OfferteProduct records
        OfferteProduct::factory(50)->create();
    }
}
