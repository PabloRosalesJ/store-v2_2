<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('people')->insert([
            'name' => 'pablo',
            'l_name' => 'rosales',
            's_name' => 'juarez',
            'address' => 'el oro',
            'phone' => '123456789' ,
            'email' => 'pablo@imd.com',
        ]);

        for ($i = 0; $i <= 30; $i++) {
            DB::table('people')->insert([
                'name' => $faker->name,
                'l_name' => $faker->lastName,
                's_name' => $faker->lastName,
                'address' => $faker->address ,
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
            ]);
        }

        DB::table('users')->insert([
            'id' => 1,
            'username' => 'UPablo',
            'password' => bcrypt('12312300')
        ]);
    }
}
