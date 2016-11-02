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

Route::group(['prefix' => 'auth'], function() {
    // Google SSO Routes
    Route::get('google', 'Auth\GoogleController@redirectToProvider');
    Route::get('google/callback', 'Auth\GoogleController@handleProviderCallback');

    // Facebook SSO Routes
    Route::get('facebook', 'Auth\FacebookController@redirectToProvider');
    Route::get('facebook/callback', 'Auth\FacebookController@handleProviderCallback');
});

Route::get('home', 'HomeController@index');

// Activity Routes
Route::group(['prefix' => 'activities'], function() {
    Route::get('/', 'ActivityController@index')->name('activity.index');

    Route::get('create', 'ActivityController@create')->name('activity.create');
    Route::post('/', 'ActivityController@store');

    Route::get('{activity}', 'ActivityController@show')->name('activity.show');

    Route::get('{activity}/edit', 'ActivityController@edit')->name('activity.edit');
    Route::put('{activity}', 'ActivityController@update');

    Route::delete('{activity}', 'ActivityController@destroy');
});
