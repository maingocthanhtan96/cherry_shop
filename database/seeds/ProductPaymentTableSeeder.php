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
        $users = \App\Models\User::all()->pluck('id')->toArray();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++){
        	\App\Models\ProductPayment::create([
                'total' => $faker->numberBetween(1000, 9000),
                'price' => $faker->randomFloat(2, 1000, 9000),
                'note' => $faker->paragraph,
                'created_by' => $faker->randomElement($users),
                'updated_by' => $faker->randomElement($users),
                //{{SEEDER_NOT_DELETE_THIS_LINE}}
			]);
		}
    }
}
