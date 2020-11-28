<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Order;
use App\User;
use App\Models\Product;

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

$factory->define( Order::class, function () {
    $array = ['самовывоз', 'доставка почтой'];
    return [
//        'user_id' => User::inRandomOrder()->value('id')
//        'product_id' => Product::inRandomOrder()->value('id'),
        'delivery' => $array[array_rand($array, 1)]
    ];
});
