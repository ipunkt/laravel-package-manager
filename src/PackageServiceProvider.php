<?php

namespace Ipunkt\Laravel\PackageManager;

use Ipunkt\Laravel\PackageManager\Support\DefinesAliases;
use Ipunkt\Laravel\PackageManager\Support\DefinesAssets;
use Ipunkt\Laravel\PackageManager\Support\DefinesMigrations;
use Ipunkt\Laravel\PackageManager\Support\DefinesRouteRegistrar;
use Ipunkt\Laravel\PackageManager\Support\DefinesRoutes;
use Ipunkt\Laravel\PackageManager\Support\DefinesTranslations;
use Ipunkt\Laravel\PackageManager\Support\DefinesViews;
use Ipunkt\Laravel\PackageManager\Support\RegistersProviders;
use Illuminate\Support\ServiceProvider;

abstract class PackageServiceProvider extends ServiceProvider
{
    /**
     * should database migrations be published
     *
     * @var bool
     */
    protected $publishDatabaseMigrations = false;

    /**
     * returns namespace of package
     *
     * @return string
     */
    abstract protected function namespace();

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ( ! $this->app->routesAreCached()) {
            /** @var \Illuminate\Routing\Router $router */
            $router = $this->app->make(\Illuminate\Routing\Router::class);

            if ($this instanceof DefinesRoutes) {
                $routesFiles = $this->routesFiles();
                foreach ((array)$routesFiles as $routesFile) {
                    // $router exists
                    if (file_exists($routesFile)) {
                        require $routesFile;
                    }
                }
            }
            if ($this instanceof DefinesRouteRegistrar) {
                $this->registerRoutesWithRouter($router);
            }
        }

        if ($this instanceof DefinesTranslations) {
            foreach ($this->translations() as $path) {
                $this->loadTranslationsFrom($path, $this->namespace());

                $this->publishes([
                    $path => resource_path('lang/vendor/' . $this->namespace()),
                ], 'translation');
            }
        }

        if ($this instanceof DefinesViews) {
            foreach ($this->views() as $path) {
                $this->loadViewsFrom($path, $this->namespace());

                $this->publishes([
                    $path => resource_path('views/vendor/' . $this->namespace()),
                ], 'view');
            }
        }

        if ($this instanceof DefinesAssets) {
            foreach ($this->assets() as $path) {
                $this->publishes([
                    $path => public_path('vendor/' . $this->namespace()),
                ], 'assets');
            }
        }

        if ($this instanceof DefinesMigrations) {
            if ($this->publishDatabaseMigrations) {
                foreach ($this->migrations() as $path) {
                    $this->publishes([
                        $path => database_path('migrations')
                    ], 'migrations');
                }
            } else {
                $this->loadMigrationsFrom($this->migrations());
            }
        }
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        if ($this instanceof RegistersProviders) {
            foreach ($this->providers() as $provider) {
                $this->app->register($provider);
            }
        }

        if ($this instanceof DefinesAliases) {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            foreach ($this->aliases() as $alias => $class) {
                $loader->alias($alias, $class);
            }
        }
    }
}