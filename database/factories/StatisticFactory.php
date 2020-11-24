<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Statistic;
use App\Apartment;
use Carbon\Carbon;

$factory->define(Statistic::class, function (Faker $faker) {
    return [
      'apartment_id'      => Apartment::inRandomOrder()->first(),
      'current_date'      => Carbon::now()->subDays(rand(2,20))->format('Y-m-d H:i:s'),
      'number_of_click'   => $faker -> numberBetween($min=0, $max=10)
    ];
});
