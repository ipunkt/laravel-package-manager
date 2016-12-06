# Package Manager

[![Total Downloads](https://poser.pugx.org/ipunkt/laravel-package-manager/d/total.svg)](https://packagist.org/packages/ipunkt/laravel-package-manager)
[![Latest Stable Version](https://poser.pugx.org/ipunkt/laravel-package-manager/v/stable.svg)](https://packagist.org/packages/ipunkt/laravel-package-manager)
[![Latest Unstable Version](https://poser.pugx.org/ipunkt/laravel-package-manager/v/unstable.svg)](https://packagist.org/packages/ipunkt/laravel-package-manager)
[![License](https://poser.pugx.org/ipunkt/laravel-package-manager/license.svg)](https://packagist.org/packages/ipunkt/laravel-package-manager)

## Introduction

Package Manager manages generation of a new package and provides a basic service provider which provides the various components loading at the right time.

## Installation

There is no direct generation for now. So please use the PackageServiceProvider as base class of your package service provider and implement the various interfaces for providing dependent stuff.


### Package providing configuration files

Simply implement our `DefinesConfigurations` interface.

```php
class YOURPACKAGEServiceProvider extends PackageServiceProvider implements DefinesConfigurations
```

Add your configuration files:
```php
    /**
     * returns an array of config files with their corresponding config_path(name)
     *
     * @return array
     */
    public function configurationFiles()
    {
        return [
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'your-package.php' => 'your-package.php',
        ];
    }
```


### Package providing database migrations

Simply implement our `DefinesMigrations` interface.

```php
class YOURPACKAGEServiceProvider extends PackageServiceProvider implements DefinesMigrations
```

Add your migration source paths:
```php
    /**
     * returns an array of migration paths
     *
     * @return array|string[]
     */
    public function migrations()
    {
        return [
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations',
        ];
    }
```

Optional you can define the publishing of your database migrations by setting protected property `$publishDatabaseMigrations` to true. Otherwise your migrations won't be published, but gets migrated.

When publishing, the tag will be `migrations`.


### Package providing views

Simply implement our `DefinesViews` interface.

```php
class YOURPACKAGEServiceProvider extends PackageServiceProvider implements DefinesViews
```

Add your view source paths:
```php
    /**
     * returns view file paths
     *
     * @return array|string[]
     */
    public function views()
    {
        return [
            $this->packagePath . 'resources' . DIRECTORY_SEPARATOR . 'views',
        ];
    }
```

When publishing, the view tag will be `view`.


### Package providing routes via file

Simply implement our `DefinesRoutes` interface.

```php
class YOURPACKAGEServiceProvider extends PackageServiceProvider implements DefinesRoutes
```

Add your routes source path:
```php
    /**
     * returns routes.php file (absolute path)
     *
     * @return string
     */
    public function routesFile()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'web.php';
    }
```


## License

Package Manager is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
