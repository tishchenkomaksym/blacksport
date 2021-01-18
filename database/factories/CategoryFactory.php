<?php

/** @var Factory $factory */

use App\Models\Category;
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

$factory->define( Category::class, function (Faker $faker) {
    $array = [ 'Одежда', 'Аксессуары', 'Экипировка', 'Сувениры', 'Литература'];
    return [
        'name' => $array[array_rand($array,1)],
        'url' => $faker->text(10),
        'image' => $faker->imageUrl(),
        'created_at' => $faker->dateTimeBetween('now', '+30 days')
    ];
});
