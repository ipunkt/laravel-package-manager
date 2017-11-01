<?php

namespace Ipunkt\Laravel\PackageManager\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Ipunkt\Laravel\PackageManager\Providers\Traits\PackagePath;

class RouteServiceProvider extends ServiceProvider
{
    use PackagePath;

    /**
     * namespace for routes
     *
     * @var string
     */
    protected $routesNamespace = null;

    /**
     * middleware for routes
     *
     * @var string|array
     */
    protected $routesMiddleware = null;

    /**
     * routes file
     *
     * @var string
     */
    protected $routesFile = 'routes/web.php';

    public function register()
    {
    }

    public function boot()
    {
        $options = [];
        if ($this->routesNamespace !== null) {
            $options['namespace'] = $this->routesNamespace;
        }
        if ($this->routesMiddleware !== null) {
            $options['middleware'] = $this->routesMiddleware;
        }

        Route::group($options, function () {
            $this->loadRoutesFrom(
                $this->packagePath($this->routesFile)
            );
        });
    }
}