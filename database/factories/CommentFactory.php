<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text(),
        'positive' => $faker->boolean,
        'validated' => $faker->boolean(70),
    ];
});
