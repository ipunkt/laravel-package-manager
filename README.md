# Package Manager

[![Total Downloads](https://poser.pugx.org/ipunkt/laravel-package-manager/d/total.svg)](https://packagist.org/packages/ipunkt/laravel-package-manager)
[![Latest Stable Version](https://poser.pugx.org/ipunkt/laravel-package-manager/v/stable.svg)](https://packagist.org/packages/ipunkt/laravel-package-manager)
[![Latest Unstable Version](https://poser.pugx.org/ipunkt/laravel-package-manager/v/unstable.svg)](https://packagist.org/packages/ipunkt/laravel-package-manager)
[![License](https://poser.pugx.org/ipunkt/laravel-package-manager/license.svg)](https://packagist.org/packages/ipunkt/laravel-package-manager)

## Introduction

Package Manager helps reducing the package creation time. Therefore it supports some basic providers for laravel packages.

## Installation

Add this package as dependency by using `composer require ipunkt/laravel-package-manager:^1.0`


## Usage

We suggest using a Package Service Provider extending the `Illuminate\Support\AggregateServiceProvider` and register all your package related providers as attribute like so:

```php
<?php

namespace MyPackage\Providers;

use Illuminate\Support\AggregateServiceProvider;

class MyPackageServiceProvider extends AggregateServiceProvider
{
	/**
	 * The provider class names.
	 *
	 * @var array
	 */
	protected $providers = [
		ConfigProvider::class,
		BindingsProvider::class,
		ArtisanProvider::class,
		MigrationsProvider::class,
		TranslationsProvider::class,
		BladeProvider::class,
		RoutesProvider::class,
		ViewProvider::class,
		EventsProvider::class,
	];
}
```

And in your `composer.json` simply auto-register only your aggregate service provider like so:

```json
{
	"extra": {
        "laravel": {
            "providers": [
                "MyPackage\\Providers\\MyPackageServiceProvider"
            ]
        }
    }
}
```

### Base Service Providers included

We include various service providers for the most common package needs. So you can simply use / extend them and at it to your package service provider.

### Package Configuration

If you want to register package configuration you have to extend the `ConfigurationServiceProvider`.

You have to add your configuration files in attribute `$configurationFiles`. File by file as array item. If you want to give an alias for config you have to set is array key. For example:

Within your package you have a `config/config.php` and you want to have it published and merged as `my-package` you have to set it like so

`'my-package' => 'config/config.php'`

Then you can get config values by using `config('my-package.)`.

#### Routes

For providing routes you have to extend the `RouteServiceProvider`.

Just set `$routesNamespace`, `$routesMiddleware` and `$routesFile` to your needs and you are ready to go. For registering various routes you should have one provider for each type of routes file (api, web, ...).


#### Artisan Commands

For registering artisan console command we provide the `ArtisanServiceProvider`.

You have to fill the `$commands` array with your commands. If you provide a key this key will be the key for registration within the IoC container of laravel. The value should be the command class name like `SuperCommand::class` or a string e.g. `SuperCommand` which gets resolved to lookup a method `registerSuperCommand` within the service provider. So you can register more complex commands by using a separate method.

By default artisan commands will registered only on console runs. If you want to change that behaviour you can overwrite the value of `$registerOnlyForConsole` to make that happen.

## License

Package Manager is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
