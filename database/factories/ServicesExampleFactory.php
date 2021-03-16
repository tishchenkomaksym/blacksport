<?php

/** @var Factory $factory */


use App\Models\ServiceInstance;
use App\Models\Service;
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

$factory->define( ServiceInstance::class, function (Faker $faker) {
    return [
        'description' => $faker->text,
        'media' => "[\"{$faker->imageUrl()}\"]",
        'service_id' => Service::inRandomOrder()->value('id'),
        'created_at' => $faker->dateTimeBetween('now', '+30 days')
    ];
});
