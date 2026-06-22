<?php

namespace App\Providers;

use ArtifactsMmo\Api\MyCharactersApi;
use ArtifactsMmo\Configuration;
use Illuminate\Support\ServiceProvider;

class ArtifactsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Configuration::class, function () {
            return Configuration::getDefaultConfiguration()
                ->setHost(config('artifacts.host'))
                ->setAccessToken(config('artifacts.token'));
        });

        $this->app->bind(MyCharactersApi::class, function ($app) {
            return new MyCharactersApi(config: $app->make(Configuration::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
