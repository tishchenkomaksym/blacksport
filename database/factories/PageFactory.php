<?php

/** @var Factory $factory */

use App\Models\Page;
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

$factory->define( Page::class, function (Faker $faker) {
    return [
        'name' => 'О нас',
        'page_key' => 'about',
        'meta_description' => $faker->text(300),
        'noindex' => false,
        'nofollow' => false,
        'created_at' => $faker->dateTimeBetween('now', '+30 days')
    ];
});
