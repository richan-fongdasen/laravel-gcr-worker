<?php

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
