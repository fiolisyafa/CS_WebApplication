<?php

use App\Itinerary;
use Faker\Generator as Faker;

$factory->define(App\Itinerary::class, function (Faker $faker) {
    return [
        'budget' => $faker->numberBetween($min = 500, $max = 1000),
        'name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'description' => $faker->text($maxNbChars = 200),
        'date_from' => '2019-4-3',
        'date_to' => '2019-4-5',
        'number_of_people' => $faker->numberBetween($min = 1, $max = 7)
    ];
});
