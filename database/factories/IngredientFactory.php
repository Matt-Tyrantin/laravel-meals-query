<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Ingredient;
use Faker\Generator as Faker;

$factory->define(Ingredient::class, function (Faker $faker) {
    $faker->addProvider(new FakerRestaurant\Provider\en_US\Restaurant($faker));

    return [
        'title' => $faker->unique()->sauceName(),
        'slug' => 'slug'
    ];
});
