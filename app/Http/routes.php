<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/movies/search', 'SearchMovieController@showSearch');
Route::get('/movies/search/query', 'SearchMovieController@showSearchQuery');
Route::get('/movies/list/latest', 'SearchMovieController@getRecentMovies');
Route::get('/movies/list/dvd', 'SearchMovieController@getRecentDVDs');
Route::get('/movies/1/{id}', ['as' => 'showMovieDetail', 'uses' => 'SearchMovieController@showMovieDetail']);
Route::post('/movies/1/{id}', 'SearchMovieController@setMovieRating');
Route::get('/profile', 'ProfileController@showProfile');
Route::post('/profile', 'ProfileController@editProfile');
Route::get('/movies/recommendations/general', 'SearchMovieController@showRecommendations');
Route::get('/movies/recommendations/major', 'SearchMovieController@showMajorRecommendations');
Route::get('/admin', ['as' => 'showUserList', 'uses' => 'AdminController@showUserList']);
Route::get('/admin/toggleBan/{id}', 'AdminController@toggleBan');
    