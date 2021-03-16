<?php



/** @var Factory $factory */
use App\Models\ParticipationRequest;
use App\Models\Program;
use App\User;
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

$factory->define( ParticipationRequest::class, function (Faker $faker) {
    return [
        'user_id' => User::inRandomOrder()->value('id'),
        'program_id' => Program::inRandomOrder()->value('id'),
        'created_at' => $faker->dateTimeBetween('now', '+30 days')
    ];
});
