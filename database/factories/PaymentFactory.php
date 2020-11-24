<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Payment;

$factory->define(Payment::class, function (Faker $faker) {
    return [
      'ref_payment'           => $faker -> sentence(),
      'start_of_sponsorship'  => $faker -> date(),
      'date_of_payment'       => now(),  
      'no_of_card'            => $faker -> creditCardNumber(),
      'cvc'                   => $faker -> numberBetween($min=100, $max=999),
      'deadline'              => $faker -> date()
    ];
});
