<?php

use Faker\Generator as Faker;
use App\DocumentType;
$factory->define(DocumentType::class, function (Faker $faker) {
    return [
    	'type' => substr($faker->text,1,25)
    ];
});
