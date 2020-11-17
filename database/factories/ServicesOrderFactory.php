<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\ParticipationRequest;
use App\Models\Program;
use App\Models\Service;
use App\Models\ServicesOrder;
use App\User;

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

$factory->define( ServicesOrder::class, function () {
    return [
        'user_id' => User::inRandomOrder()->value('id'),
        'service_id' => Service::inRandomOrder()->value('id')
    ];
});
