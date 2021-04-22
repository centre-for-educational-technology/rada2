<?php

namespace App\Providers;

use App\Services\AjapaikService;
use App\Services\GeocodingService;
use App\Services\MuinasService;
use Illuminate\Support\ServiceProvider;
use App\Services\ImageService;
use App\Services\SocialAccountService;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ImageService::class, function()
        {
            return new ImageService();
        });

        $this->app->singleton(SocialAccountService::class, function()
        {
            return new SocialAccountService();
        });

        $this->app->singleton(AjapaikService::class, function() {
            return new AjapaikService();
        });

        $this->app->singleton(MuinasService::class, function() {
            return new MuinasService();
        });

        $this->app->singleton(GeocodingService::class, function () {
            return new GeocodingService();
        });
    }
}
