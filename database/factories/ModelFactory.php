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

$factory->define(Noah\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Noah\Blog::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomElement(Noah\User::lists('id')->toArray()),
        'body' => $faker->paragraph(5),
        'type' => 1,
        'user_agent' => $faker->userAgent,
        'ip' => $faker->ipv4
    ];
});