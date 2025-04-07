<?php

namespace Onixstudio\ApiVersion;

use Illuminate\Support\ServiceProvider;

class ApiVersionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }
}
