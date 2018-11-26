<?php

use Faker\Generator as Faker;
use App\RequerimentType;

$factory->define(RequerimentType::class, function (Faker $faker) {
    return [
    	'type' => substr($faker->text,1,25)
    ];
});
