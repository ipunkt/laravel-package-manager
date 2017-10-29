<?php

namespace Ipunkt\Laravel\PackageManager\Providers;

use Illuminate\Support\ServiceProvider;
use Ipunkt\Laravel\PackageManager\Providers\Traits\PackagePath;

class TranslationServiceProvider extends ServiceProvider
{
    use PackagePath;

    /**
     * translation namespace
     *
     * @var string
     */
    protected $namespace = null;

    /**
     * folder for your language based translation files
     * de, en and so are folders within the given folder name
     *
     * @var string
     */
    protected $translationsFolder = 'resources/lang';

    /**
     * do you want to load translations from json format
     *
     * @var bool
     */
    protected $useJson = false;

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->packagePath($this->translationsFolder) => resource_path('lang/vendor/' . $this->namespace),
            ], 'translation');
        }
    }

    public function boot()
    {
        if ($this->useJson) {
            $this->loadJsonTranslationsFrom($this->translationsFolder);

            return;
        }

        $this->loadTranslationsFrom(
            $this->packagePath($this->translationsFolder),
            $this->namespace
        );
    }
}