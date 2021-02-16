<?php

/** @var Factory $factory */

use App\Models\News;
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

$factory->define( News::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->text,
        'images' => "[\"{$faker->imageUrl()}\"]",
        'published' => now()->toDateTime()->format('Y-m-d H:i:s'),
        'created_at' => $faker->dateTimeBetween('now', '+30 days'),
        'hide_date' => $faker->boolean
    ];
});
