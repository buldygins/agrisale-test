<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductSeed::class);
        $this->call(ProductVariationSeed::class);
        $this->call(DealerSeed::class);
        $this->call(ProductOfferSeed::class);
    }
}
