<?php

namespace Database\Seeders;

use App\Models\Dealer;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DealerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < 5; $i++) {
            Dealer::query()->create([
                'name' => $faker->firstName,
            ]);
        }
    }
}
