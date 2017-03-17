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

Route::get('/', function()
{
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'auth'], function()
{
    // Google SSO Routes
    Route::get('google', 'Auth\GoogleController@redirectToProvider');
    Route::get('google/callback', 'Auth\GoogleController@handleProviderCallback');

    // Facebook SSO Routes
    Route::get('facebook', 'Auth\FacebookController@redirectToProvider');
    Route::get('facebook/callback', 'Auth\FacebookController@handleProviderCallback');
});

Route::group(['prefix' => 'dashboard'], function()
{
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('results', 'ActivityController@resultsIndex')->name('results');
    Route::get('{activity}/results', 'ActivityController@results')->name('activity.results');
});

Route::group(['prefix' => 'profile'], function() {
    Route::get('{user}', 'UserController@show')->name('user.profile');
    Route::get('{user}/edit', 'UserController@edit')->name('user.profile.edit');
    Route::put('{user}', 'UserController@update');
});

// Activity Routes
Route::group(['prefix' => 'activities'], function()
{
    Route::get('/', 'ActivityController@index')->name('activity.index');

    Route::get('create', 'ActivityController@create')->name('activity.create');
    Route::post('/', 'ActivityController@store');

    Route::get('{activity}', 'ActivityController@show')->name('activity.show');
    //Route::get('{activity}/play', 'ActivityController@play')->name('activity.play');

    Route::get('{activity}/edit', 'ActivityController@edit')->name('activity.edit');
    Route::put('{activity}', 'ActivityController@update');

    Route::delete('{activity}', 'ActivityController@destroy')->name('activity.delete');

    Route::post('{activity}/start', 'ActivityController@start')->name('activity.start');
});

Route::group(['prefix' => 'games'], function()
{
    Route::get('{game}/play', 'GameController@play')->name('game.play');
});

// ActivityItem Routes
Route::group(['prefix' => 'activity_items'], function()
{
  Route::get('/', 'ActivityItemController@index')->name('activity_item.index');

  Route::get('create', 'ActivityItemController@create')->name('activity_item.create');
  Route::post('/', 'ActivityItemController@store');

  Route::get('{activity_item}', 'ActivityItemController@show')->name('activity_item.show');

  Route::get('{activity_item}/edit', 'ActivityItemController@edit')->name('activity_item.edit');
  Route::put('{activity_item}', 'ActivityItemController@update');

  Route::delete('{activity_item}', 'ActivityItemController@destroy')->name('activity_item.delete');
});

// Management routes
Route::group(['prefix' => 'manage'], function()
{
    Route::group(['prefix' => 'users'], function()
    {
        Route::get('/', 'UserController@index')->name('manage.users');
        Route::post('{user}', 'UserController@assignRoles');
    });
});
