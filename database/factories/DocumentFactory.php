<?php

use Faker\Generator as Faker;
use App\DocumentType;
use App\Document;
use App\Client;
use App\Requeriment;

$factory->define(Document::class, function (Faker $faker) {
    return [
    	'name' => substr($faker->text,1,150),
        'document_type_id' =>factory(DocumentType::class)->create()->id,
        'owner_id' =>factory(Client::class)->create()->id,
        'file_path' => $faker->url,
        'requeriment_id' =>factory(Requeriment::class)->create()->id, 

    ];
});