<?php

namespace Aammui\LaravelMedia;

use Aammui\LaravelMedia\Models\Media;
use Illuminate\Support\ServiceProvider;

class LaravelMediaServiceProvider extends ServiceProvider
{
    /**
     * Register Services
     */
    public function register()
    {
        $this->app->bind('media', Media::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations')
        ], 'migrations');
    }
}
