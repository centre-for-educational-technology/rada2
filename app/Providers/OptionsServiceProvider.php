<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Options\ZooOptions;
use App\Options\ActivityTypeOptions;
use App\Options\LanguageOptions;
use App\Options\QuestionTypeOptions;
use App\Options\ZooGeolocationOptions;

class OptionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ZooOptions::class, function($app) {
            return new ZooOptions();
        });

        $this->app->singleton(ActivityTypeOptions::class, function($app) {
            return new ActivityTypeOptions();
        });

        $this->app->singleton(LanguageOptions::class, function($app) {
            return new LanguageOptions();
        });

        $this->app->singleton(QuestionTypeOptions::class, function($app) {
            return new QuestionTypeOptions();
        });

        $this->app->singleton(ZooGeolocationOptions::class, function($app) {
            return new ZooGeolocationOptions();
        });
    }
}
