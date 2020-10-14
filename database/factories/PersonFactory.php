<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'l_name' => $faker->lastName,
        's_name' => $faker->lastName,
        'address' => $faker->address ,
        'phone' => $faker->phoneNumber ,
        'email' => $faker->unique()->safeEmail, 
    ];
});
