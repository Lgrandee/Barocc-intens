<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomerUpdateSeeder extends Seeder
{
    public function run(): void
    {
        // Deze seeder is niet meer nodig omdat we de circulaire FK's hebben verwijderd
        // Customers hebben geen FK meer naar offertes, facturen en contracts
    }
}
