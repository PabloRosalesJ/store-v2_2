<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => random_int(1, 18),
        'bar_code' => Str::random(30),
        'name' => $faker->unique()->word().' '.Str::random(6),
        'description' => $faker->sentence(3),
        'image' => $faker->image(),
        'buy_price' => random_int(20,1200),
        'unit_price' => random_int(20,1200),
        'wholesale_price' => random_int(20,1200),
        'stock' => random_int(10,30)
    ];
});
