<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // # UserSeeder::class,
            PersonSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            SaleSeeder::class,
            IncomeSeeder::class,
            CreditSeeder::class,
            PaymentSeeder::class,
            ]);
    }
}