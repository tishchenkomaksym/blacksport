<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ServiceController;
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
Route::group(['as' => 'api.'], function (){
// Bag API

    Route::get('basket', 'BasketController@get');

    Route::post('basket/{id}/{n?}', 'BasketController@post') -> where('id', '[0-9]+')
         -> where('n', '[0-9]+');

    Route::patch('basket/{id}/{n}', 'BasketController@patch') -> where('id', '[0-9]+')
         -> where('n', '[0-9]+');

    Route::delete('basket/{id}', 'BasketController@delete') -> where('id', '[0-9]+');

    Route::post('return-wayforpay', [ BasketController::class, 'checkResponse'])-> name('check-response');
    Route::post('payment', [ BasketController::class, 'payment']);

    Route::get('/home/{locale?}', 'HomeController@index')->name('home');
    Route::get('/about/{locale?}', 'AboutController@index')->name('about');
    Route::get('/products/{locale?}', [ ProductController::class, 'index'])->name('products');
    Route::get('/product/{id}/{locale?}', [ ProductController::class, 'show'])->name('product');
    Route::get('/product_category/{categoryId}/{locale?}', [ ProductController::class, 'productCategoryFilter'])->name('product.category');
    Route::get('/news/{locale?}', 'NewsController@index')->name('news');
    Route::get('/news/{id}/{locale?}', [ NewsController::class, 'show'])->name('news.model');
    Route::get('/services/{locale?}', 'ServiceController@index')->name('services');
    Route::get('/programs/{locale?}', 'ProgramController@index')->name('programs');
    Route::post('/program/request', [ ProgramController::class, 'store'])->name('program.request');
    Route::post('/service/request', [ ServiceController::class, 'store'])->name('service.request');
    Route::get('/contacts/{locale?}', [ ContactController::class, 'index'])->name('contacts');
    Route::get('/categories/{locale?}', [ CategoryController::class, 'index'])->name('categories');
    Route::get('/partners/{locale?}', [ PartnerController::class, 'index'])->name('partners');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
