<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'status' => '1',
        'title' => $faker->realText($maxNbChars = 10, $indexSize = 1),
        'text' => $faker->realText($maxNbChars = 50, $indexSize = 1),
    ];
});