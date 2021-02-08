<?php

/** @var Factory $factory */

use App\Models\Contact;
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

$factory->define( Contact::class, function (Faker $faker) {
    return [
        'phone' => $faker->phoneNumber,
        'email' => $faker->companyEmail,
        'social_links' => "https://www.facebook.com/, https://www.instagram.com",
        'address' => $faker->address,
        'name' => $faker->name,
        'ipn' => $faker->randomNumber(),
        'law_address' => $faker->address
    ];
});
