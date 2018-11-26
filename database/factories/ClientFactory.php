<?php

use Faker\Generator as Faker;
use App\Client;
use App\Company;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'username' => $faker->unique()->userName,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'company_id' => factory(Company::class)->create()->id
    ];
});
