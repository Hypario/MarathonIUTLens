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

// show series
Route::get('/serie', 'SerieController@index')->name('serie.index');
Route::get('/serie/{serie}','SerieController@show')->name('serie.show');
Route::get('/serie/{serie}/{episode}','SerieController@episode')->name('episode.show');

Route::get("/userpage","MainController@user")->name('user.home');
