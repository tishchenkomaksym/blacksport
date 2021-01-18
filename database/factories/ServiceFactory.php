<?php

/** @var Factory $factory */

use App\Models\Program;
use App\Models\Service;
use App\Models\ServiceInstance;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

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

$factory->define( Service::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'description' => $faker->text(),
        'created_at' => $faker->dateTimeBetween('now', '+30 days')
    ];
});
