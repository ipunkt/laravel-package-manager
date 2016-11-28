# Package Manager

[![Total Downloads](https://poser.pugx.org/donepm/package-manager/d/total.svg)](https://packagist.org/packages/donepm/oauth-introspection)
[![Latest Stable Version](https://poser.pugx.org/donepm/package-manager/v/stable.svg)](https://packagist.org/packages/donepm/oauth-introspection)
[![Latest Unstable Version](https://poser.pugx.org/donepm/package-manager/v/unstable.svg)](https://packagist.org/packages/donepm/oauth-introspection)
[![License](https://poser.pugx.org/donepm/package-manager/license.svg)](https://packagist.org/packages/donepm/oauth-introspection)

## Introduction

Package Manager manages generation of a new package and provides a basic service provider which provides the various components loading at the right time.

## Installation

There is no direct generation for now. So please use the PackageServiceProvider as base class of your package service provider and implement the various interfaces for providing dependent stuff.


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
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'migrations',
        ];
    }
```

Optional you can define the publishing of your database migrations by setting protected property `$publishDatabaseMigrations` to true. Otherwise your migrations won't be published, but gets migrated.

When publishing, the tag will be `migrations`.

## License

Package Manager is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
