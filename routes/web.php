<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('auth/google', 'Auth\GoogleController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\GoogleController@handleProviderCallback');

Route::get('auth/facebook', 'Auth\FacebookController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleProviderCallback');

Route::get('home', 'HomeController@index');

Route::get('activities', [
    'uses' => 'ActivityController@index',
    'as' => 'activity.index',
]);
Route::get('activities/create', [
    'uses' => 'ActivityController@create',
    'as' => 'activity.create',
])->middleware('auth');
Route::post('activities', 'ActivityController@store')->middleware('auth');
Route::get('activities/{id}', [
    'uses' => 'ActivityController@show',
    'as' => 'activity.show',
]);
/*
Route::get('activities/{id}/edit', [
    'uses' => 'ActivityController@edit',
    'as' => 'activity.edit',
]);
Route::put('activities/{id}', 'ActivityController@update')->middleware('auth');
Route::delete('activities/{id}', 'ActivityController@destroy')->middleware('auth');
*/
