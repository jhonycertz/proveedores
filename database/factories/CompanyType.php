<?php

use Faker\Generator as Faker;
use App\CompanyType;

$factory->define(CompanyType::class, function (Faker $faker) {
    return [
    	'type' => substr($faker->text,1,25)
    ];
});
