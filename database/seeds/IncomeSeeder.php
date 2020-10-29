<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 200; $i++) { 
            DB::table('incomes')->insert([
                'user_id' => random_int(1, 10),
                'number' => '000'.$i,
                'total' => random_int(800, 1200),
                'created_at' => Carbon::now()
            ]);
        }

        for ($i=0; $i < 300; $i++) { 
            DB::table('income_details')->insert([
                'income_id' => random_int(1, 200),
                'product_id' => random_int(1, 30),
                'quantity' => random_int(10,30),
                'price' => random_int(275, 300),
                'sub_total' => random_int(4000, 4500),
            ]);
        }
    }
}
