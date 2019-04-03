<?php

use Faker\Generator as Faker;

$factory->define(App\CustomActivity::class, function (Faker $faker) {
    return [
    	'name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'description' => $faker->text($maxNbChars = 200),
        'fee' => $faker->numberBetween($min = 10, $max = 80),
        'date_time' => $faker->dateTimeBetween($startDate = '2019-4-3', $endDate = '2019-4-5', $timezone = null),
    ];
});
