<?php

use Faker\Generator as Faker;

$factory->define(App\SelectedActivity::class, function (Faker $faker) {
    return [
        'date_time' => $faker->dateTimeBetween($startDate = '2019-4-3', $endDate = '2019-4-5', $timezone = null),
    ];
});
