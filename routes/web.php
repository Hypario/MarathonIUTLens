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

Route::get('/', 'MainController@index')->name('home');

Route::get('/series', 'SeriesController@index')->name('series.index');

Route::get('/series/{id}/saison/{num}', 'SeriesController@saison')->name('series.saison');

Route::get('/genres', function () {
    //$genres = DB::table('genres')->select('nom')->distinct()->pluck('nom');
    $genres = Genre::distinct()->select('nom')->orderBy('nom')->get();
    //return implode(",",$genres->toArray());
    return GenreResource::collection($genres);
});
