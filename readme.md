
![Build Status](https://github.com/richan-fongdasen/laravel-gcr-worker/workflows/Build/badge.svg?branch=master)
[![codecov](https://codecov.io/gh/richan-fongdasen/laravel-gcr-worker/branch/master/graph/badge.svg)](https://codecov.io/gh/richan-fongdasen/laravel-gcr-worker)
[![Total Downloads](https://poser.pugx.org/richan-fongdasen/laravel-gcr-worker/d/total.svg)](https://packagist.org/packages/richan-fongdasen/laravel-gcr-worker)
[![Latest Stable Version](https://poser.pugx.org/richan-fongdasen/laravel-gcr-worker/v/stable.svg)](https://packagist.org/packages/richan-fongdasen/laravel-gcr-worker)
[![License: MIT](https://poser.pugx.org/richan-fongdasen/laravel-gcr-worker/license.svg)](https://opensource.org/licenses/MIT)

# Laravel GCR Worker

> Simple background processing implementation with Google Cloud Run and Google Cloud Pub/Sub

## Synopsis

This package would help you to implement any background processing in Laravel like queue worker
or scheduled job in Google Cloud Run by handling the triggered HTTP event invocation.

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

| Laravel version | Package version |
|:----------------|:----------------|
| 5.7 - 8.x       | 1.0 - 1.3       |
| 8.x - 10.x      | ^1.5            |

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
    | Allow Event invocation
    |--------------------------------------------------------------------------
    |
    | Specify whether the application would allow and handle any event
    | invocations, such as Pub/Sub topic message published events, Cloud
    | scheduler jobs, etc.
    |
    */

    'allow_event_invocation' => (bool) env('ALLOW_EVENT_INVOCATION', false),


    /*
    |--------------------------------------------------------------------------
    | Maximum Execution Time
    |--------------------------------------------------------------------------
    |
    | Set the max execution time in seconds, the default value is 15 minutes.
    |
    | Warning:
    | This value doesn't update the maximum execution time defined in your
    | nginx, apache or php-fpm configuration. You need to update them manually.
    |
    */

    'max_execution_time' => 60 * 15,


    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Define the middleware which should be attached in every GCR worker route.
    |
    */

    'middleware' => [
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \RichanFongdasen\GCRWorker\Middleware\AllowEventInvocation::class,
    ],


    /*
    |--------------------------------------------------------------------------
    | Path prefix
    |--------------------------------------------------------------------------
    |
    | Define the path prefix of the Pub/Sub event handler url.
    |
    */

    'path_prefix' => 'gcr-worker',
];
```

## Usage

The content for this section is under development.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
