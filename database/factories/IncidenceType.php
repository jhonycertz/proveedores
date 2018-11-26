<?php

use Faker\Generator as Faker;
use App\IncidenceType;

$factory->define(IncidenceType::class, function (Faker $faker) {
    return [
    	'type' => substr($faker->text,1,25)
    ];
});
