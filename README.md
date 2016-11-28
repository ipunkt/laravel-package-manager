# Package Manager

[![Total Downloads](https://poser.pugx.org/donepm/package-manager/d/total.svg)](https://packagist.org/packages/donepm/oauth-introspection)
[![Latest Stable Version](https://poser.pugx.org/donepm/package-manager/v/stable.svg)](https://packagist.org/packages/donepm/oauth-introspection)
[![Latest Unstable Version](https://poser.pugx.org/donepm/package-manager/v/unstable.svg)](https://packagist.org/packages/donepm/oauth-introspection)
[![License](https://poser.pugx.org/donepm/package-manager/license.svg)](https://packagist.org/packages/donepm/oauth-introspection)

## Introduction

Package Manager manages generation of a new package and provides a basic service provider which provides the various components loading at the right time.

## Installation

Just install the package on your authorization server

	composer require donepm/package-manager

and add the Service Provider in your `config/app.php`

	\DonePM\PackageManager\DonePMPackageManagerServiceProvider::class,

## License

Package Manager is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
