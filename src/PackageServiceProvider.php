<?php

namespace Ipunkt\Laravel\PackageManager;

use Ipunkt\Laravel\PackageManager\Support\DefinesAliases;
use Ipunkt\Laravel\PackageManager\Support\DefinesAssets;
use Illuminate\Support\ServiceProvider;

abstract class PackageServiceProvider extends ServiceProvider
{
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
        if ($this instanceof DefinesAssets) {
            foreach ($this->assets() as $path) {
                $this->publishes([
                    $path => public_path('vendor/' . $this->namespace()),
                ], 'assets');
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
        if ($this instanceof DefinesAliases) {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            foreach ($this->aliases() as $alias => $class) {
                $loader->alias($alias, $class);
            }
        }
    }
}