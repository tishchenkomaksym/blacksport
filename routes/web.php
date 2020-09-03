<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::resource('user', 'UserController');
//Route::resource('news', 'NewsController');
//Route::resource('page', 'PageController');
//Route::resource('ambassador', 'AmbassadorController');
//Route::resource('partner', 'PartnerController');
//Route::resource('service', 'ServiceController');
//Route::resource('servicesexapmle', 'ServicesExapmleController');
//Route::resource('category', 'CategoryController');
//Route::resource('product', 'ProductController');
//Route::resource('order', 'OrderController');
//Route::resource('program', 'ProgramController');
//Route::resource('participationrequest', 'ParticipationRequestController');
//Route::resource('servicesorder', 'ServicesOrderController');

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/main', 'HomeController@main')->name('home')->middleware('auth');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
