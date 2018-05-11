<?php

namespace Bitnetic\JsonApi;

use Illuminate\Support\ServiceProvider;

/**
 * Class JsonApiServiceProvider
 * @package Bitnetic\JsonApi
 */
class JsonApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/jsonapi.php' => config_path('jsonapi.php'),
        ], 'config');
    }

    public function register()
    {
    }
}
