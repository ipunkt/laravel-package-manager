<?php

namespace Ipunkt\Laravel\PackageManager\Providers;

use Illuminate\Support\ServiceProvider;
use Ipunkt\Laravel\PackageManager\Providers\Traits\PackagePath;

class MigrationServiceProvider extends ServiceProvider
{
    use PackagePath;

    /**
     * folder for your blade template files
     *
     * @var string|array|string[]
     */
    protected $migrationsFolder = 'database/migrations';

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->packagePath($this->migrationsFolder) => database_path('migrations'),
            ], 'migrations');
        }
    }

    public function boot()
    {
        $this->loadMigrationsFrom(
            $this->packagePath($this->migrationsFolder)
        );
    }
}
