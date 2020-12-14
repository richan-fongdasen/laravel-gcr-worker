<?php

namespace RichanFongdasen\GCRWorker;

use ErrorException;
use Google\Cloud\PubSub\Message;
use Illuminate\Container\Container;
use Kainxspirits\PubSubQueue\Connectors\PubSubConnector;
use Kainxspirits\PubSubQueue\Jobs\PubSubJob;
use Kainxspirits\PubSubQueue\PubSubQueue;

class PubSubEvent
{
    /**
     * Pub/Sub connector instance.
     *
     * @var PubSubConnector
     */
    protected $connector;

    /**
     * Laravel IOC Container instance.
     *
     * @var Container
     */
    protected $container;

    /**
     * Pub/Sub queue instance.
     *
     * @var PubSubQueue
     */
    protected $queue;

    /**
     * PubSubEvent constructor.
     *
     * @param Container       $container
     * @param PubSubConnector $connector
     *
     * @throws ErrorException
     */
    public function __construct(Container $container, PubSubConnector $connector)
    {
        $this->container = $container;
        $this->connector = $connector;
        $this->queue = $this->getQueue();
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
            $this->queue,
            $message,
            config('queue.connections.pubsub.driver'),
            config('queue.connections.pubsub.queue')
        );
    }

    /**
     * Get the PubSubQueue instance.
     *
     * @throws ErrorException
     *
     * @return PubSubQueue
     */
    protected function getQueue(): PubSubQueue
    {
        $queue = $this->connector->connect(config('queue.connections.pubsub'));

        if (!($queue instanceof PubSubQueue)) {
            throw new ErrorException('Failed to retrieve PubSubQueue instance.');
        }

        return $queue;
    }

    /**
     * Handle the given Pub/Sub event message.
     *
     * @param Message $message
     */
    public function handle(Message $message): void
    {
        set_time_limit(config('gcr-worker.max_execution_time'));

        $this->createJob($message)->fire();
    }
}
