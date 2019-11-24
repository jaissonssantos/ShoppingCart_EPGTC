<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'sku' => $faker->randomLetter,
        'name' => $faker->name,
        'slug' => $faker->randomLetter,
        'image' => $faker->randomLetter,
        'description' => $faker->word,
        'stock' => $faker->randomDigit,
        'price' => $faker->numberBetween(100, 1000),
        'sale_price' => $faker->numberBetween(10, 100),
        'user_id' => function () {
            return App\User::all()->random();
        },
    ];
});
