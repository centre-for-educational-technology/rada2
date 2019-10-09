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

Route::get('/', 'WelcomeController@welcome');

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

Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');

Route::post('locale/{locale}', 'LocaleController@set')->name('locale.set');

Route::group(['prefix' => 'dashboard'], function()
{
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('results', 'ActivityController@resultsIndex')->name('results');
    Route::get('{activity}/results', 'ActivityController@results')->name('activity.results');
    Route::get('{game}/positions', 'GameController@downloadPlayerPositions')->name('game.positions');
});

Route::group(['prefix' => 'profile'], function() {
    Route::get('{user}', 'UserController@show')->name('user.profile');
    Route::get('{user}/edit', 'UserController@edit')->name('user.profile.edit');
    Route::put('{user}/block', 'UserController@block')->name('user.block');
    Route::put('{user}/unblock', 'UserController@unblock')->name('user.unblock');
    Route::put('{user}', 'UserController@update');
    Route::delete('{user}', 'UserController@destroy')->name('user.delete');
});

// Activity Routes
Route::group(['prefix' => 'game'], function()
{
    Route::get('/', 'ActivityController@index')->name('activity.index');
    Route::get('/promoted', 'ActivityController@promotedIndex')->name('activity.promoted');

    Route::get('create', 'ActivityController@create')->name('activity.create');
    Route::post('/', 'ActivityController@store');

    Route::get('{activity}/duplicate', 'ActivityController@duplicate')->name('activity.duplicate');
    Route::put('{activity}/duplicate', 'ActivityController@storeDuplication')->name('activity.store.duplication');

    Route::get('{activity}', 'ActivityController@show')->name('activity.show');
    Route::get('{activity}/qrcode', 'ActivityController@qrCodeDownload')->name('activity.qrcode.download');

    Route::get('{activity}/edit', 'ActivityController@edit')->name('activity.edit');
    Route::put('{activity}', 'ActivityController@update');

    Route::delete('{activity}', 'ActivityController@destroy')->name('activity.delete');

    Route::post('{activity}/start', 'ActivityController@start')->name('activity.start');

    Route::get('{activity}/mark-started', 'ActivityController@markStarted')->name('activity.mark-started');
    Route::get('{activity}/mark-stopped', 'ActivityController@markStopped')->name('activity.mark-stopped');

    Route::get('{activity}/start-monitoring', 'ActivityController@startMonitoring')->name('activity.start-monitoring');
});

Route::group(['prefix' => 'games'], function()
{
    Route::get('{game}/play', 'GameController@play')->name('game.play');
    Route::get('{game}/stopped', 'GameController@stopped')->name('game.stopped');
    Route::get('{game}/monitoring', 'GameController@monitoring')->name('game.monitoring');
});

// ActivityItem Routes
Route::group(['prefix' => 'tasks'], function()
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
    Route::get('statistics', 'StatisticsController@index')->name('manage.statistics');
});

// Badges
Route::group(['prefix' => 'badges'], function()
{
    Route::get('/', 'BadgeController@index')->name('badge.index');
});

// DiscountVoucher routes
Route::group(['prefix' => 'discount_vouchers'], function()
{
    Route::get('/', 'DiscountVoucherController@index')->name('discount_voucher.index');

    Route::group(['prefix' => 'manage'], function()
    {
        Route::get('/', 'DiscountVoucherController@manage')->name('discount_voucher.manage');

        Route::get('/create', 'DiscountVoucherController@create')->name('discount_voucher.create');
        Route::post('/', 'DiscountVoucherController@store');

        Route::get('{voucher}/edit', 'DiscountVoucherController@edit')->name('discount_voucher.edit');
        Route::put('{voucher}', 'DiscountVoucherController@update');

        Route::delete('{voucher}', 'DiscountVoucherController@destroy')->name('discount_voucher.delete');
    });
});

// Legal pages
Route::group(['prefix' => 'legal'], function()
{
    Route::get('/terms_and_conditions', 'LegalController@termsAndConditions')->name('legal.terms');
    Route::get('/privacy_policy', 'LegalController@privacyPolicy')->name('legal.policy');
});

Route::group(['prefix' => 'grading'], static function ()
{
    Route::get('/', 'GradingController@index')->name('grading.index');
    Route::get('/page/{page}', 'GradingController@index')->name('grading.index.page');
    Route::get('/{answer}/edit', 'GradingController@edit')->name('grading.edit');
    Route::put('/{answer}', 'GradingController@update')->name('grading.update');
});
