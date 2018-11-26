<?php

use Faker\Generator as Faker;
use App\Question;
use App\Client;

$factory->define(Question::class, function (Faker $faker) {
    return [
   		'question' => substr($faker->text,1,50),
   		'client_id' => factory(Client::class)->create()->id
    ];
});

