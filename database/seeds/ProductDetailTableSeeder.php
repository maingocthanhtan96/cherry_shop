<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-05 21:05:22
 */
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $products = \App\Models\Product::all()->pluck('id')->toArray();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++){
        	\App\Models\ProductDetail::create([
                'price' => $faker->name,
                'amount' => $faker->numberBetween(1000, 9000),
                'product_id' => $faker->randomElement($products),
                //{{SEEDER_NOT_DELETE_THIS_LINE}}
			]);
		}
    }
}
