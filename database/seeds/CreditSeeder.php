<?php

use Illuminate\Database\Seeder;

use App\Models\Person;
use App\Models\User;
use App\Models\Credit;
use App\Models\Product;

class CreditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 50; $i++) {
            DB::table('credits')->insert([
                'people_id'  => Person::inRandomOrder()->first()->id,
                'user_id'    => User::inRandomOrder()->first()->id,
                'take'       => random_int(0,1),
                'total'      => 50,
                'created_at' => \Carbon\Carbon::now()->subDays($i)
            ]);
        }

        for ($i = 0; $i <= 300; $i++) {
            $pices = random_int(1,20);
            $cost = random_int(20,700);
            DB::table('credti_details')->insert([
                'credit_id'  => Credit::inRandomOrder()->first()->id,
                'product_id' => Product::inRandomOrder()->first()->id,
                'pices'      => $pices,
                'cost'       => $cost,
                'sub_total'  => $cost * $pices,
            ]);
        }
    }
}
