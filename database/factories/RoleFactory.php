<?php

use Faker\Generator as Faker;
use App\Role;
use App\Operation;

$factory->define(Role::class, function (Faker $faker) {
    return [
    	'role' => substr($faker->text,1,50),
    ];
});

$factory->state(Role::class,'Administration',['role' => 'Administration A']);

$factory->afterCreatingState(Role::class,'Administration', function($administration){
	$administration->permisions()->save(factory(Operation::class)->create());
	$administration->permisions()->save(factory(Operation::class)->create());
	$administration->permisions()->save(factory(Operation::class)->create());
	$administration->permisions()->save(factory(Operation::class)->create());
});