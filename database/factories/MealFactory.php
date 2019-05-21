<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Meal;
use Faker\Generator as Faker;

$factory->define(Meal::class, function (Faker $faker) {
    $faker->addProvider(new FakerRestaurant\Provider\en_US\Restaurant($faker));

    return [
        'title' => $faker->foodName(),
        'description' => $faker->text,
        'category_id' => $faker->optional(0.8)->numberBetween(1, 5),
        'status' => 'created'
    ];
});
