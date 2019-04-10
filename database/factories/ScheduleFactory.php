<?php

use App\Models\StationSchedule;
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

$factory->define(StationSchedule::class, function (Faker $faker) {
    return [
        'date' => $faker->date(),
        'open_from' => $faker->time(),
        'open_till' => $faker->time(),
        'lunch_start' => $faker->time(),
        'lunch_end' => $faker->time(),
        'is_closed' => $faker->boolean(20)
    ];
});
