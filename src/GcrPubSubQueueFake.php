<?php

namespace RichanFongdasen\GCRWorker;

use Google\Cloud\PubSub\Message;
use Illuminate\Support\Collection;
use Kainxspirits\PubSubQueue\Connectors\PubSubConnector;
use PHPUnit\Framework\Assert as PHPUnit;
use RichanFongdasen\GCRWorker\Concerns\CreatesPubSubQueue;

class GcrPubSubQueueFake
{
    use CreatesPubSubQueue;

    /**
     * The collection of acknowledged messages.
     *
     * @var Collection
     */
    protected Collection $acknowledgedMessages;

    /**
     * GcrPubSubQueue constructor.
     *
     * @param PubSubConnector $connector
     *
     * @throws \ErrorException
     */
    public function __construct(PubSubConnector $connector)
    {
        $this->acknowledgedMessages = new Collection();

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
        $this->acknowledgedMessages->put($message->id(), $message);
    }

    /**
     * Assert if the acknowledged messages count equals to the given value.
     *
     * @param int $count
     */
    public function assertAcknowledgedMessagesCount(int $count): void
    {
        PHPUnit::assertEquals($count, $this->acknowledgedMessages->count());
    }

    /**
     * Assert if the given message id has been acknowledged.
     *
     * @param string $messageId
     */
    public function assertMessageHasAcknowledged(string $messageId): void
    {
        PHPUnit::assertTrue($this->acknowledgedMessages->has($messageId));
    }

    /**
     * Pull a specific PubSub message from PubSub topic specified by the given message id.
     *
     * @param Message $original
     *
     * @return Message
     */
    public function pullFreshMessage(Message $original): Message
    {
        return $original;
    }
}
