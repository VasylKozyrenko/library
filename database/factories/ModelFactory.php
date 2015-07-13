<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->define(App\User::class, function ($faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => 'secret'
    ];
});

$factory->define(App\Book::class, function ($faker) {
    return [
        'title' => $faker->word,
        'author' => $faker->userName,
        'year' => $faker->dateTimeThisYear,
        'genre' => $faker->word,
    ];
});
