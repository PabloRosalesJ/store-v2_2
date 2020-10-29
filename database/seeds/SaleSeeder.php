<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 200; $i++) { 
            DB::table('sales')->insert([
                'people_id' => random_int(1, 30),
                'user_id' => random_int(1, 10),
                'serie' => Str::random(10),
                'total' => random_int(275, 300),
                'created_at' => Carbon::now()
            ]);
        }

        for ($i=0; $i < 300; $i++) { 
            DB::table('sales_details')->insert([
                'sale_id' => random_int(1, 200),
                'product_id' => random_int(1, 30),
                'quantity' => random_int(1, 30),
                'price' => random_int(275, 300),
                'discount' => random_int(275, 300),
                'sub_total' => random_int(275, 300),
            ]);
        }
    }
}
