<?php

use Faker\Generator as Faker;

use App\Data_user;
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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(Data_user::class, function (Faker $faker) {
    return [
        'user_id'=> factory(App\User::class)->create()->id,
        'name'=> $faker->name,
        'avatar'=> $faker->imageUrl($width = 640, $height = 480, $category = null, $randomize = true, $word = null, $gray = false),
        'work'=> $faker->company(),
        'tel'=> $faker->phoneNumber(),
        'adres'=> $faker->address,
        'status_id' => $faker->randomFloat($nbMaxDecimals = null, $min = 1, $max = 3)
    ];
});
