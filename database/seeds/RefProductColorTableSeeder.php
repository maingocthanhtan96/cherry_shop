<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 22:04:24
 */
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RefProductColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $colors = \App\Models\Color::all()->pluck('id')->toArray();
        $products = \App\Models\Product::all()->pluck('id')->toArray();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++){
        	\App\Models\RefProductColor::create([
                'color_id' => $faker->randomElement($colors),
                'product_id' => $faker->randomElement($products),
                
			]);
		}
    }
}
