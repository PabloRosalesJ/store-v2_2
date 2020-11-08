<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

use App\Models\Person;
use App\Models\User;
use App\Models\Sale;
use App\Models\Product;

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
                'people_id' => Person::inRandomOrder()->first()->id,
                'user_id' => User::inRandomOrder()->first()->id,
                'serie' => Str::random(10),
                'total' => random_int(275, 300),
                'created_at' => Carbon::now()->subDays(200 - $i)
            ]);
        }

        for ($i=0; $i < 300; $i++) { 
            $quantity = random_int(1, 30);
            $price = random_int(275, 300);
            DB::table('sales_details')->insert([
                'sale_id' => Sale::inRandomOrder()->first()->id,
                'product_id' => Product::inRandomOrder()->first()->id,
                'quantity' => $quantity,
                'price' => $price,
                'discount' => 0,
                'sub_total' => $price * $quantity,
            ]);
        }
    }
}
