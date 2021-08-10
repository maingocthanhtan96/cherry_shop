<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:58:19
 */
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductPaymentTableSeeder extends Seeder
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
        $members = \App\Models\Member::all()->pluck('id')->toArray();
        $colors = \App\Models\Color::all()->pluck('id')->toArray();
        $sizes = \App\Models\Size::all()->pluck('id')->toArray();
        $products = \App\Models\Product::all()
            ->pluck('id')
            ->toArray();
        $users = \App\Models\User::all()
            ->pluck('id')
            ->toArray();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {
            \App\Models\ProductPayment::create([
                'total' => $faker->numberBetween(1000, 9000),
                'price' => $faker->randomFloat(2, 1000, 9000),
                'note' => $faker->paragraph,
                'created_by' => $faker->randomElement($users),
                'updated_by' => $faker->randomElement($users),
                'product_id' => $faker->randomElement($products),
                'size_id' => $faker->randomElement($sizes),
                'color_id' => $faker->randomElement($colors),
                'member_id' => $faker->randomElement($members),
                'product_detail_id' => $faker->randomElement($productDetails),
                //{{SEEDER_NOT_DELETE_THIS_LINE}}
            ]);
        }
    }
}
