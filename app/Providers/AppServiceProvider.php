<?php

namespace App\Providers;

use App\Services\AjapaikService;
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
    }
}
