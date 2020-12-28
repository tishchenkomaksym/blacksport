<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProgramController;
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

Route::post('return-wayforpay', [ BasketController::class, 'checkResponse'])-> name('check-response');
Route::post('wayforpay', [ BasketController::class, 'wayForPayRequest']);

Route::get('/home/{locale?}', 'HomeController@index');
Route::get('/about/{locale?}', 'AboutController@index');
Route::get('/products/{locale?}', [ ProductController::class, 'index']);
Route::get('/product/{id}/{locale?}', [ ProductController::class, 'show']);
Route::get('/product_category/{categoryId}/{locale?}', [ ProductController::class, 'productCategoryFilter']);
Route::get('/news/{locale?}', 'NewsController@index');
Route::get('/news/{id}/{locale?}', [ NewsController::class, 'show']);
Route::get('/services/{locale?}', 'ServiceController@index');
Route::get('/programs/{locale?}', 'ProgramController@index');
Route::post('/program/request', [ ProgramController::class, 'store']);
Route::get('/contacts', [ ContactController::class, 'index']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
