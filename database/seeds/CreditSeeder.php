<?php

use Illuminate\Database\Seeder;

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
                'people_id' => random_int(1,32),
                'user_id'   => 1,
                'take'      => random_int(0,1),
                'total'     => 50,
                'created_at' => \Carbon\Carbon::now()->subDays($i)
            ]);
        }

        for ($i = 0; $i <= 30; $i++) {
            DB::table('credti_details')->insert([
                'credit_id'  => random_int(1,10),
                'product_id' => random_int(1,31),
                'pices'      => random_int(1,5),
                'cost'       => 50,
                'sub_total'  => 300,
                'created_at' => \Carbon\Carbon::now()->subDays($i)
            ]);
        }
    }
}
