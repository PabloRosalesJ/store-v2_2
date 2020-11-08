<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i <= 30; $i++) {
            DB::table('products')->insert([
                'category_id' => Category::inRandomOrder()->first()->id,
                'bar_code' => Str::random(10),
                'name' => $faker->unique()->word().' '.$i,
                'description' => $faker->sentence(3),
                'image' => $faker->image(),
                'buy_price' => 100,
                'unit_price' => 100,
                'wholesale_price' => 100,
                'stock' => random_int(20,25)
            ]);
        }
    }
}
