<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:55:13
 */
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++){
        	\App\Models\Color::create([
                'name' => $faker->name,
                //{{SEEDER_NOT_DELETE_THIS_LINE}}
			]);
		}
    }
}
