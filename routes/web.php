<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;



Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/news', 'NewsController@index')->name('news');
Route::get('/services', 'ServiceController@index')->name('services');
Route::get('/programs', 'ProgramController@index')->name('programs');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/main', 'HomeController@main')->name('main')->middleware('auth');



