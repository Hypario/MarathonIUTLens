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
Route::get('/genre/{genre}', 'MainController@genre')->name('home.genre');

// show series
Route::get('/serie', 'SerieController@index')->name('serie.index');
Route::get('/serie/{serie}','SerieController@show')->name('serie.show');
Route::get('/serie/{serie}/{episode}','SerieController@episode')->name('episode.show');
Route::get('/serie/{serie}/saison/{saison}','SerieController@saison')->name('saison.show');

// comments
Route::post('/comment/{serie}', "CommentController@create")->name("comment.post");
Route::post('/comment/{comment}/valid', "CommentController@valid")->name("comment.valid");
Route::post('/comment/{comment}/reject', "CommentController@reject")->name("comment.reject");

Route::get("/userpage","MainController@user")->name('user.home');

Route::get('/seeSerie/{id}', "SerieController@see")->name("serie.see");

Route::get('/seeEpisode/{id}', "EpisodeController@see")->name("episode.see");
Route::get('/modifAvis/{id}',"SerieController@modif_avis")->name("admin.avis");
Route::post('/modifAvis/{id}/send',"SerieController@send_avis")->name("admin.sndavis");
