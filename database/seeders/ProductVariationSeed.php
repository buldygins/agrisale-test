<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariation;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductVariationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');
        $products = Product::all();
        foreach ($products as $product) {
            $options = ['Стандарт', 'Экстра', 'Супер', 'Ультра', null];
            for ($i = 0; $i < 4; $i++) {
                $random_option_key = array_rand($options);
                $option = $options[$random_option_key];
                unset($options[$random_option_key]);
                ProductVariation::query()->create([
                    'product_id' => $product->id,
                    'option' => $option,
                    'unit' => $faker->randomElement([150000, 75000, null]),
                    'recommend_price' => $faker->randomElement([rand(100, 200) * 100, null]),
                ]);
            }
        }
        /*
         *
         */
    }
}
