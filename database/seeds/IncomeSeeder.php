<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

use App\Models\User;
use App\Models\Income;
use App\Models\Product;

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
                'user_id' => User::inRandomOrder()->first()->id,
                'number' => '000'.$i,
                'total' => random_int(800, 1200),
                'created_at' => Carbon::now()->subDays(200 - $i)
            ]);
        }

        for ($i=0; $i < 300; $i++) { 

            $quantity = random_int(10,30);
            $price = random_int(275, 300);

            DB::table('income_details')->insert([
                'income_id' => Income::inRandomOrder()->first()->id,
                'product_id' => Product::inRandomOrder()->first()->id,
                'quantity' => $quantity,
                'price' => $price,
                'sub_total' => $quantity * $price,
            ]);
        }
    }
}
