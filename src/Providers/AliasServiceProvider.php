<?php

namespace Ipunkt\Laravel\PackageManager\Providers;

use Illuminate\Support\ServiceProvider;

class AliasServiceProvider extends ServiceProvider
{
    /**
     * Alias map
     *
     * Alias => Facade Class
     *
     * @var array
     */
    protected $aliases = [];

    public function register()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        foreach ($this->aliases as $alias => $class) {
            $loader->alias($alias, $class);
        }
    }
}