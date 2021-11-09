<?php

namespace RichanFongdasen\GCRWorker;

use Google\Cloud\PubSub\Message;
use Kainxspirits\PubSubQueue\Connectors\PubSubConnector;
use RichanFongdasen\GCRWorker\Concerns\CreatesPubSubQueue;

class GcrPubSubQueue
{
    use CreatesPubSubQueue;

    /**
     * GcrPubSubQueue constructor.
     *
     * @param PubSubConnector $connector
     * @throws \ErrorException
     */
    public function __construct(PubSubConnector $connector)
    {
        $this->setConnector($connector);
        $this->initializeQueue();
    }

    /**
     * Acknowledge the given message.
     *
     * @param Message $message
     */
    public function acknowledge(Message $message): void
    {
        $this->pubSub->acknowledge($message);
    }
}
