<?php

namespace Onixstudio\ApiVersion;

use Illuminate\Support\ServiceProvider;

class ApiVersionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Onixstudio\ApiVersion\Console\InstallApiVersionCommand::class,
            ]);
        }
    }
}
