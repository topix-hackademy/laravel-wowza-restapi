<?php

namespace Topix\Hackademy\LaravelWowza;


use Topix\Hackademy\LaravelWowza\Handler\WowzaHandlerSdk;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service providers.
     *
     * @return void
     */
    public function register()
    {
        // Main Service
        $this->app->bind(WowzaHandlerSdk::class, function ($app) {
            return new WowzaHandlerSdk();
        });
    }
}
