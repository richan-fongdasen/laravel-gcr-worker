<?php

namespace RichanFongdasen\GCRWorker\Tests\Feature;

use Illuminate\Support\Facades\Cache;
use RichanFongdasen\GCRWorker\Tests\TestCase;

class PubSubEventHandlingTest extends TestCase
{
    /** @test */
    public function it_will_return_403_on_unauthorized_pubsub_request()
    {
        $data = json_decode(file_get_contents(dirname(__DIR__, 2).'/dummies/message.json'), true);

        $this->postJson('/gcr-worker/pub-sub/event-handler', $data)
            ->assertStatus(403);
    }

    /** @test */
    public function it_can_handle_pubsub_invocation_as_expected()
    {
        $this->withoutExceptionHandling();
        config(['gcr-worker.allow_pubsub_invocation' => true]);

        $data = json_decode(file_get_contents(dirname(__DIR__, 2).'/dummies/message.json'), true);

        self::assertNull(Cache::get('dummy-job-status'));

        $this->postJson('/gcr-worker/pub-sub/event-handler', $data)
            ->assertStatus(200)
            ->assertJsonFragment(['info' => 'The Pub/Sub job has completed.']);

        self::assertEquals('completed', Cache::get('dummy-job-status'));
    }
}
