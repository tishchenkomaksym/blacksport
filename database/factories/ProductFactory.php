<?php

/** @var Factory $factory */

use App\Models\Category;
use App\Models\Product;
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

$factory->define( Product::class, function (Faker $faker) {
    return [
        'description' => $faker->text(),
        'specifications' => $faker->text(300),
        'image' => $faker->imageUrl(),
        'price' => rand(1000, 2000),
        'category_id' => Category::inRandomOrder()->value('id')
    ];
});
