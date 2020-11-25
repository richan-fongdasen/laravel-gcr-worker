<?php

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
