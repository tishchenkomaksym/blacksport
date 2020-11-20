<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Bag API

Route::get('basket', 'BasketController@get');

Route::post('basket/{id}/{n?}', 'BasketController@post') -> where('id', '[0-9]+')
     -> where('n', '[0-9]+');

Route::patch('basket/{id}/{n}', 'BasketController@patch') -> where('id', '[0-9]+')
     -> where('n', '[0-9]+');

Route::delete('basket/{id}', 'BasketController@delete') -> where('id', '[0-9]+');

Route::get('/home/{locale?}', 'HomeController@index');
Route::get('/about/{locale?}', 'AboutController@index');
Route::get('/news/{locale?}', 'NewsController@index');
Route::get('/services/{locale?}', 'ServiceController@index');
Route::get('/programs/{locale?}', 'ProgramController@index');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
