<?php

namespace RichanFongdasen\GCRWorker\Concerns;

use ErrorException;
use Kainxspirits\PubSubQueue\Connectors\PubSubConnector;
use Kainxspirits\PubSubQueue\PubSubQueue;

trait CreatesPubSubQueue
{
    /**
     * Pub/Sub connector instance.
     *
     * @var PubSubConnector
     */
    protected $connector;

    /**
     * The base PubSubQueue instance.
     *
     * @var PubSubQueue
     */
    protected $pubSub;

    /**
     * Create the PubSubQueue instance.
     *
     * @throws ErrorException
     *
     * @return PubSubQueue
     */
    private function createQueue(): PubSubQueue
    {
        $queue = $this->connector->connect(config('queue.connections.pubsub', ['project_id' => 'default-project-id']));

        if (!($queue instanceof PubSubQueue)) {
            throw new ErrorException('Failed to retrieve PubSubQueue instance.');
        }

        return $queue;
    }

    /**
     * Retrieve the PubSubConnector instance.
     *
     * @return PubSubConnector
     */
    public function getConnector(): PubSubConnector
    {
        return $this->connector;
    }

    /**
     * Retrieve the PubSubQueue instance.
     *
     * @return PubSubQueue
     */
    public function getPubSubQueue(): PubSubQueue
    {
        return $this->pubSub;
    }

    /**
     * Initialize the PubSubQueue instance.
     *
     * @throws ErrorException
     */
    protected function initializeQueue(): void
    {
        $this->pubSub = $this->createQueue();
    }

    /**
     * Set the PubSubConnector instance.
     *
     * @param PubSubConnector $connector
     */
    public function setConnector(PubSubConnector $connector): void
    {
        $this->connector = $connector;
    }
}
