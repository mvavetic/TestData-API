<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\People;
use Illuminate\Support\Str;
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

$factory->define(People::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'nickname' => $faker->name,
        'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'country' => rand(1,250),
    ];
});
