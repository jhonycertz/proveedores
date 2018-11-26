<?php

use Faker\Generator as Faker;
use App\Reply;
use App\Question;
use App\User;

$factory->define(Reply::class, function (Faker $faker) {
    return [
		'reply' => $faker->text,
		'question_id' => factory(Question::class)->create()->id,
		'user_id' => factory(User::class)->create()->id
    ];
});
