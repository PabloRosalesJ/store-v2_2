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
            CategorySeeder::class,
            ProductSeeder::class,
            PersonSeeder::class,
            SaleSeeder::class,
            IncomeSeeder::class,
            CreditSeeder::class,
            PaymentSeeder::class,
            ]);
    }
}
