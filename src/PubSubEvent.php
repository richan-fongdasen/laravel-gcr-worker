<?php

namespace RichanFongdasen\GCRWorker;

use Google\Cloud\PubSub\Message;
use Illuminate\Container\Container;
use Kainxspirits\PubSubQueue\Jobs\PubSubJob;
use RichanFongdasen\GCRWorker\Facade\GcrQueue;

class PubSubEvent
{
    /**
     * Laravel IOC Container instance.
     *
     * @var Container
     */
    protected Container $container;

    /**
     * PubSubEvent constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Create a new Pub/Sub job based on the given Pub/Sub message.
     *
     * @param Message $message
     *
     * @return PubSubJob
     */
    protected function createJob(Message $message): PubSubJob
    {
        return new PubSubJob(
            $this->container,
            GcrQueue::getPubSubQueue(),
            $message,
            config('queue.connections.pubsub.driver'),
            config('queue.connections.pubsub.queue')
        );
    }

    /**
     * Handle the given Pub/Sub event message.
     *
     * @param Message $message
     */
    public function handle(Message $message): void
    {
        set_time_limit(config('gcr-worker.max_execution_time'));

        GcrQueue::acknowledge($message);

        $this->createJob($message)->fire();
    }
}
