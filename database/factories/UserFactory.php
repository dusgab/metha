<?php

use Faker\Generator as Faker;

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

$factory->define(MOHA\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'apellido' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('1234'),
        'dni' => $faker->randomDigit(8),
        'telefono' => $faker->randomDigit(10),
        'domicilio' => $faker->streetAddress,
        'id_ciudad' => $faker->numberBetween($min = 1, $max = 200),
        'id_provincia' => $faker->numberBetween($min = 1, $max = 24),
        'id_des' => $faker->numberBetween($min = 5, $max = 9),
        'id_rep' => $faker->numberBetween($min = 2, $max = 2),
        'activo' => $faker->boolean(true),
        'remember_token' => str_random(10),
    ];
});
