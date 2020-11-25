[![Build Status](https://travis-ci.org/richan-fongdasen/laravel-gcr-worker.svg?branch=master)](https://travis-ci.org/richan-fongdasen/laravel-gcr-worker)
[![codecov](https://codecov.io/gh/richan-fongdasen/laravel-gcr-worker/branch/master/graph/badge.svg)](https://codecov.io/gh/richan-fongdasen/laravel-gcr-worker)
[![Total Downloads](https://poser.pugx.org/richan-fongdasen/laravel-gcr-worker/d/total.svg)](https://packagist.org/packages/richan-fongdasen/laravel-gcr-worker)
[![Latest Stable Version](https://poser.pugx.org/richan-fongdasen/laravel-gcr-worker/v/stable.svg)](https://packagist.org/packages/richan-fongdasen/laravel-gcr-worker)
[![License: MIT](https://poser.pugx.org/richan-fongdasen/laravel-gcr-worker/license.svg)](https://opensource.org/licenses/MIT)

# Laravel GCR Worker

> Package tag line

## Synopsis

Package synopsis

## Table of contents

- [Setup](#setup)
- [Configuration](#configuration)
- [Usage](#usage)
- [License](#license)

## Setup

Install the package via Composer :

```sh
$ composer require richan-fongdasen/laravel-gcr-worker
```

### Laravel version compatibility

| Laravel version | Package version   |
| :-------------- | :---------------- |
| 8.x             | 1.x               |

## Configuration

Publish configuration file using `php artisan` command

```sh
$ php artisan vendor:publish --provider="RichanFongdasen\GCRWorker\ServiceProvider"
```

The command above would copy a new configuration file to `/config/gcr-worker.php`

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Allow Pub/Sub invocation
    |--------------------------------------------------------------------------
    |
    | This configuration will specify whether the application would allow
    | and handle pub/sub event invocation or not.
    |
    */

    'allow_pubsub_invocation' => (bool) env('ALLOW_PUBSUB_INVOCATION', false),


    /*
    |--------------------------------------------------------------------------
    | Path prefix
    |--------------------------------------------------------------------------
    |
    | This configuration will specify the path prefix of the Pub/Sub event
    | handler url.
    |
    */

    'path_prefix' => 'gcr-worker',
];
```

## Usage

Usage and tutorial goes here.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.