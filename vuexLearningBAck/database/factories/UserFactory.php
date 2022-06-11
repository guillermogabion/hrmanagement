<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        // 'id'=> rand(10000,999999),
        'employee_id'=> rand(10000,999999),
        'first_name' => $faker->firstname,
        'last_name' => $faker->lastname,
        'mid_name' => $faker->lastname,
        'birth_date' => $faker->date,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'person_to_contact' => $faker->name,
        'to_contact_number' => $faker->phoneNumber,
        'user_type' => 1,
        'email' => $faker->unique()->safeEmail,
        'password'=>Hash::make('password'),
    ];
});
