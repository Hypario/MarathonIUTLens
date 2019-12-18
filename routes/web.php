<?php

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

use App\Genre;
use App\Http\Resources\GenreResource;
use App\Http\Resources\SerieResource;
use App\Serie;

Auth::routes();

// landing page and sorting
Route::get('/', 'MainController@index')->name('home');
Route::get('/random', 'MainController@random')->name('home.random');
Route::get('/popular', 'MainController@popular')->name('home.popular');

// show series
Route::get('/serie', 'SerieController@index')->name('serie.index');
Route::get('/serie/{serie}','SerieController@show')->name('serie.show');
Route::get('/reviews', 'MainController@reviews')->name('home.reviews');
