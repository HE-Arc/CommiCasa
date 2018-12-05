<?php

use Faker\Generator as Faker;

$factory->define(CommiCasa\Category::class, function (Faker $faker) {
    $userID = $faker->numberBetween($min = 1, $max = 2);

    return [
        'name' => $faker->name,
        'user_id' => $userID,
    ];
});
