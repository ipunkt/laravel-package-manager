<?php

namespace Ipunkt\Laravel\PackageManager\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class ConfigurationServiceProvider extends ServiceProvider
{
    /**
     * configuration files
     *
     * file[] or
     * alias => file
     *
     * @var array
     */
    protected $configurationFiles = [];

    /**
     * registering
     */
    public function register()
    {
        $this->configurations()->each(function (array $configuration) {
            $this->mergeConfigFrom(
                $configuration['file'], $configuration['key']
            );

            if ($this->app->runningInConsole()) {
                $this->publishes([
                    $configuration['file'] => config_path($configuration['alias']),
                ], 'config');
            }
        });
    }

    /**
     * prepares configuration
     *
     * @return \Illuminate\Support\Collection
     */
    protected function configurations(): Collection
    {
        $configurations = collect();

        foreach ($this->configurationFiles as $alias => $file) {
            if (is_numeric($alias)) {
                $alias = $file;
            }

            $key = $alias;
            if (ends_with($key, '.php')) {
                $key = str_replace('.php', '', $key);
            }

            $configurations->push([
                'file' => $file,
                'alias' => $alias,
                'key' => $key,
            ]);
        }

        return $configurations;
    }
}