<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 22:05:47
 */
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RefProductSizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $sizes = \App\Models\Size::all()->pluck('id')->toArray();
        $products = \App\Models\Product::all()->pluck('id')->toArray();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++){
        	\App\Models\RefProductSize::create([
                'size_id' => $faker->randomElement($sizes),
                'product_id' => $faker->randomElement($products),
                
			]);
		}
    }
}
