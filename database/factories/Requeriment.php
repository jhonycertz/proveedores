<?php

use Faker\Generator as Faker;
use App\RequerimentType;
use App\Requeriment;
$factory->define(Requeriment::class, function (Faker $faker) {
    return [
		'name' => $faker->name,
		'code'  => $faker->numerify('R'.$faker->randomLetter().'-###'),
		'required'  => $faker->boolean(),
		'requeriment_type_id'  => factory(RequerimentType::class)->create()->id,
    ];
});
