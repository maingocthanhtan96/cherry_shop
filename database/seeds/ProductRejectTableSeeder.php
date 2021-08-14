<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 22:00:29
 */
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductRejectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $productDetails = \App\Models\ProductDetail::all()->pluck('id')->toArray();
        $products = \App\Models\Product::all()->pluck('id')->toArray();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++){
        	\App\Models\ProductReject::create([
                'total' => $faker->numberBetween(1000, 9000),
                'price' => $faker->randomFloat(2, 1000, 9000),
                'note' => $faker->paragraph,
                'product_id' => $faker->randomElement($products),
                'product_detail_id' => $faker->randomElement($productDetails),
                //{{SEEDER_NOT_DELETE_THIS_LINE}}
			]);
		}
    }
}
