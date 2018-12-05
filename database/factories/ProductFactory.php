<?php

use Faker\Generator as Faker;

$factory->define(CommiCasa\Product::class, function (Faker $faker) {
    $userID = $faker->numberBetween($min = 1, $max = 2);
    $categoryID = $faker->numberBetween($min = 1, $max = 5);
    return [
        'name' => $faker->name,
        'quantity' => $faker->numberBetween($min = 0, $max = 15),
        'user_id' => $userID,
        'category_id' => $categoryID,
        'regular' => $faker->numberBetween($min = 0, $max = 1),
        'alert' => $faker->numberBetween($min = 0, $max = 5),
        'image' => 'default.png'
    ];
});