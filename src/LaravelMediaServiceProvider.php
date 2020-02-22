<?php

namespace Aammui\LaravelMedia;

use Illuminate\Support\ServiceProvider;

class LaravelMediaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->publishes([
        //     __DIR__ . '/../config/role-permission.php' => config_path('role-permission.php')
        // ], 'config');

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations')
        ], 'migrations');
    }
}
