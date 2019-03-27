<?php

use Faker\Generator as Faker;

$factory->define(App\SuggestedActivity::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'description' => $faker->text($maxNbChars = 200),
        'fee' => $faker->numberBetween($min = 10, $max = 80),
        'image' => 'images/default.png',
        'promo' => $faker->boolean,
    ];
});
