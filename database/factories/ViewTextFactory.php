<?php

/** @var Factory $factory */


use App\Models\Page;
use App\Models\ViewText;
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

$factory->define( ViewText::class, function (Faker $faker) {
    return [
        'description' => $faker->text,
        'page_id' => Page::inRandomOrder()->value('id'),
        'created_at' => $faker->dateTimeBetween('now', '+30 days')
    ];
});
