<?php

namespace RichanFongdasen\GCRWorker;

use ErrorException;
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
     *
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

    /**
     * Pull a specific PubSub message from PubSub topic specified by the given message id.
     *
     * @param Message $original
     *
     * @throws ErrorException
     *
     * @return Message
     */
    public function pullFreshMessage(Message $original): Message
    {
        $topic = $this->pubSub->getTopic($this->pubSub->getQueue(null));
        $subscription = $topic->subscription($this->pubSub->getSubscriberName());

        $messages = $subscription->pull(['returnImmediately' => true, 'maxMessages' => 10]);

        foreach ($messages as $message) {
            if (!($message instanceof Message)) {
                continue;
            }
            if ($message->id() === $original->id()) {
                return $message;
            }
        }

        throw new ErrorException(sprintf('Failed to pull a PubSub message with id "%s"', $original->id()));
    }
}
