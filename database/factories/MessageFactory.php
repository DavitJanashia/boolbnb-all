<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [

      'email'      => $faker -> email(),
      'message'    => $faker -> paragraph($nbSentences = 3, $variableNbSentences = true)
      
    ];
});
