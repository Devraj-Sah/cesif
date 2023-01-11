<?php

namespace kujjs\imageManager;

use Illuminate\Support\ServiceProvider;

class imageManagerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/image-manager.php' => config_path('imageManager.php'),
            ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(kujjs\imageManager\Facades\ImageManager::class, function($app) {
            return new imageManager;
        });
        $this->app['ImageManager'] = $this->app->make(kujjs\imageManager\Facades\ImageManager::class);
        
    }
}