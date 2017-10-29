<?php

namespace Ipunkt\Laravel\PackageManager\Providers;

use Illuminate\Support\ServiceProvider;
use Ipunkt\Laravel\PackageManager\Providers\Traits\PackagePath;

class ViewServiceProvider extends ServiceProvider
{
    use PackagePath;

    /**
     * views namespace
     *
     * @var string
     */
    protected $namespace = null;

    /**
     * folder for your blade template files
     *
     * @var string
     */
    protected $templatesFolder = 'resources/views';

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->packagePath($this->templatesFolder) => resource_path('views/vendor/' . $this->namespace),
            ], 'view');
        }
    }

    public function boot()
    {
        $this->loadViewsFrom(
            $this->packagePath($this->templatesFolder),
            $this->namespace
        );
    }
}