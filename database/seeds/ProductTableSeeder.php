<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:53:12
 */
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $categories = \App\Models\Category::all()->pluck('id')->toArray();
        $users = \App\Models\User::all()->pluck('id')->toArray();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++){
        	\App\Models\Product::create([
                'code' => $faker->name,
                'name' => $faker->name,
                'image' => $faker->name,
                'description' => $faker->paragraph,
                'stock_in' => $faker->numberBetween(1000, 9000),
                'stock_out' => $faker->numberBetween(1000, 9000),
                'inventory' => $faker->numberBetween(1000, 9000),
                'price' => $faker->randomFloat(2, 1000, 9000),
                'discount' => $faker->numberBetween(1000, 9000),
                'status' => $faker->numberBetween(0, 1),
                'created_by' => $faker->randomElement($users),
                'updated_by' => $faker->randomElement($users),
                'category_id' => $faker->randomElement($categories),
                //{{SEEDER_NOT_DELETE_THIS_LINE}}
			]);
		}
    }
}
