<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
       return [
    	'identification_card' => $faker->randomNumber,
        'name' => $faker->name,
        'lastname' => $faker->lastname,
        'address' =>$faker->streetAddress,
        'phone_number' =>$faker->phoneNumber,
        'city' =>$faker->city,
        'country' =>$faker->country,
        'date_of_birth' =>$faker->date($format = 'Y-m-d', $max = 'now'),
        'gender' =>$faker->randomElement(['male', 'female']),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'api_token' =>Str::random(10),
        'remember_token' => Str::random(10),
    ];
});
