<?php

Route::post('/pub-sub/event-handler', 'PubSubEventController@store')->name('queue_handler');
Route::get('/run-scheduled-job', 'ScheduledJobController@index')->name('schedule_handler');
