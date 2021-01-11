<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */



use App\Models\Service;
use App\Models\ServicesOrder;
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

$factory->define( ServicesOrder::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'service_id' => Service::inRandomOrder()->value('id')
    ];
});
