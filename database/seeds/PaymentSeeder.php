<?php

use Illuminate\Database\Seeder;
use App\Payment;
use App\Apartment;
use App\Sponsorship;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Payment::class, 3)
    -> make()
    -> each(function($pay){
      $apart = Apartment::inRandomOrder() -> first();
      $spons = Sponsorship::inRandomOrder() -> first();
      $pay -> apartment() -> associate($apart);
      $pay -> sponsorship() -> associate($spons);
      $pay -> save();
    });
    }
}
