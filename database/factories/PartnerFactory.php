<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ambassador;

use App\Models\Partner;
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

$factory->define( Partner::class, function (Faker $faker) {
    return [
        'description' => $faker->text,
        'logo_image' => $faker->imageUrl(),
        'avatar_image' => $faker->imageUrl()
    ];
});
