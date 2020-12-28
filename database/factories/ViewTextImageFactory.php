<?php

/** @var Factory $factory */


use App\Models\Service;
use App\Models\ViewText;
use App\Models\ViewTextImage;
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

$factory->define( ViewTextImage::class, function (Faker $faker) {
    return [
        'image' => $faker->imageUrl(),
        'view_texts_id' => ViewText::inRandomOrder()->value('id')
    ];
});
