<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i <= 4; $i++) {
            DB::table('categories')->insert([
                'name' => $faker->sentence(2),
                'description' => $faker->sentence(3)
            ]);
        }
    }
}
