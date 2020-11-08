<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

use App\Models\Person;
use App\Models\User;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 200; $i++) { 
            DB::table('payments')->insert([
                'client_id' => Person::inRandomOrder()->first()->id,
                'user_id' => User::inRandomOrder()->first()->id,
                'amount' => random_int(50, 300),
                'created_at' => Carbon::now()->subDays(200 - $i)
            ]);
        }
    }
}
