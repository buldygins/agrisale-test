<?php

namespace Database\Seeders;

use App\Models\Dealer;
use App\Models\ProductOffer;
use App\Models\ProductVariation;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductOfferSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');
        $product_variations = ProductVariation::all();
        $dealers = Dealer::all();
        foreach ($product_variations as $variation) {
            foreach ($dealers as $dealer) {
                $price = rand(100, 500) * 100;
                // На случай, если у продукта нет рекомендованой цены, у предложения всегда будет цена
                $priceArr = !empty($variation->recommend_price) ? [$price, $price, null] : [$price];
                ProductOffer::query()->create([
                    'product_variation_id' => $variation->id,
                    'dealer_id' => $dealer->id,
                    'price' => $faker->randomElement($priceArr),
                ]);
            }
        }
    }
}
