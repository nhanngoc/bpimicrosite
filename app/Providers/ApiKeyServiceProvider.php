<?php

namespace App\Providers;

use App\Console\Commands\ActivateApiKey;
use App\Console\Commands\DeactivateApiKey;
use App\Console\Commands\DeleteApiKey;
use App\Console\Commands\GenerateApiKey;
use App\Console\Commands\ListApiKeys;
use App\Http\Middleware\AuthorizeApiKey;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class ApiKeyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->commands([
            ActivateApiKey::class,
            DeactivateApiKey::class,
            DeleteApiKey::class,
            GenerateApiKey::class,
            ListApiKeys::class,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        //
        $this->registerMiddleware($router);
    }

    protected function registerMiddleware(Router $router)
    {
        $router->aliasMiddleware('auth.apikey', AuthorizeApiKey::class);
    }
}
