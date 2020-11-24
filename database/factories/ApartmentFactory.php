<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Apartment;
use Faker\Generator as Faker;

$factory->define(Apartment::class, function (Faker $faker) {
    return [

      'description'               => $faker -> sentence(),
      'number_of_rooms'           => $faker -> numberBetween($min=1, $max=10),
      'number_of_beds'            => $faker -> numberBetween($min=1, $max=10),
      'number_of_bathrooms'       => $faker -> numberBetween($min=1, $max=7),
      'square_meters'             => $faker -> numberBetween($min=50, $max=500),
      'address'                   => $faker -> streetAddress(),
      'city'                      => $faker -> city(),
      'state'                     => $faker -> state(),
      'lat'                       => $faker -> latitude($min = 89, $max = 90),
      'lng'                       => $faker -> longitude($min = 0, $max = 1),

      // 'date_of_creation'       =>'',
      // 'sponsorship'               => $faker -> boolean(),
      // 'visibility'                => $faker -> boolean()

    ];
});
