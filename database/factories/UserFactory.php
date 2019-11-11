<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->firstNameFemale,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt(env('ADMIN_PASSWORD')),
        'remember_token' => str_random(10),
    ];
});
