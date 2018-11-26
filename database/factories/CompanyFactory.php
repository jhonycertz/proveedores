<?php

use Faker\Generator as Faker;
use App\Company;
use App\CompanyType;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'identity' => $faker->unique()->safeEmail,
        'address' => $faker->address,
        'phone' => '04158888888',
        'company_type_id' => factory(CompanyType::class)->create()->id,
		'email' => $faker->unique()->safeEmail,
		'catalogo_path' => 'document.pdf'
    ];
});


