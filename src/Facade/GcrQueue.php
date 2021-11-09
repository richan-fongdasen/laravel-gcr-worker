<?php

namespace RichanFongdasen\GCRWorker\Facade;

use Illuminate\Support\Facades\Facade;
use RichanFongdasen\GCRWorker\GcrPubSubQueue;
use RichanFongdasen\GCRWorker\GcrPubSubQueueFake;

class GcrQueue extends Facade
{
    /**
     * Replace the bound instance with a fake.
     *
     * @return GcrPubSubQueueFake
     */
    public static function fake(): GcrPubSubQueueFake
    {
        $fake = app(GcrPubSubQueueFake::class);
        static::swap($fake);

        return $fake;
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return GcrPubSubQueue::class;
    }
}
