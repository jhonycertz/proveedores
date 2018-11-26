<?php

use Faker\Generator as Faker;
use App\Operation;

$factory->define(Operation::class, function (Faker $faker) {
    return [
    	'operation' => substr($faker->text,1,50),
    	'group' => substr($faker->text,1,50) 
    ];
});

$factory->state(Operation::class,'operationA',['operation' => 'Operation A', 'group' => 'ABC']);
$factory->state(Operation::class,'operationB',['operation' => 'Operation B', 'group' => 'DEF']);
