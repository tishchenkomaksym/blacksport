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
    $array = ["square", "rectangle"];
    return [
        'description' => $faker->text,
        'image' => $faker->imageUrl(),
        'image_type' => $array[array_rand($array,1)]
    ];
});
