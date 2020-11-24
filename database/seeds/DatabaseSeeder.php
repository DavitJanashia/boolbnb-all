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
          UserSeeder::class,
          SponsorshipSeeder::class,
          ServiceSeeder::class,
          ApartmentSeeder::class,
          PaymentSeeder::class,
          MessageSeeder::class,
          StatisticSeeder::class
        ]);
    }
}
