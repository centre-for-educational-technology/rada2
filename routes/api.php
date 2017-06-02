<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'games'], function()
{
    Route::post('answer', 'GameController@answer');
});

Route::group(['prefix' => 'activity_items'], function() {
    Route::get('search', 'ActivityItemController@search');
});

Route::group(['prefix' => 'manage', 'middleware' => 'auth.admin'], function()
{
    Route::delete('users/{user}/roles/{role}', 'UserController@removeRole');
});

Route::group(['prefix' => 'badges'], function()
{
    Route::get('issuer', 'BadgeController@issuer')->name('api.badge.issuer');
    Route::get('key', 'BadgeController@publicKey')->name('api.badge.key');
    Route::get('mine', 'BadgeController@mine')->name('api.badge.mine');
    Route::post('mine', 'BadgeController@sent');
    Route::get('{badge}', 'BadgeController@badge')->name('api.badge.show');
    Route::get('{badge}/user/{user}', 'BadgeController@assertion')->name('api.badge.assertion');
});
