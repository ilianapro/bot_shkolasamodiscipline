<?php

use Faker\Generator as Faker;

$factory->define(App\participant::class, function (Faker $faker) {
    $first_name = $faker->firstNameFemale;
    $last_name = $faker->lastName;
    $username = $first_name.'.'.$last_name;
    return [
        'user_id'       =>  random_int(112345678,212345678),
        'username'      =>  $username,
        'first_name'    =>  $first_name,
        'last_name'     =>  $last_name,
        'phone'         =>  $faker->phoneNumber,
        'status'        =>  random_int(0,1),
        'group_id'      =>  random_int(1,10),
    ];
});
