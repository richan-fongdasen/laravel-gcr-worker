<?php

Route::post('/pub-sub/event-handler', 'PubSubEventController@store')->name('pubsub_handler');
