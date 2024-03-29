<?php

namespace RichanFongdasen\GCRWorker\Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use RichanFongdasen\GCRWorker\Tests\TestCase;

class ScheduledJobHandlingTest extends TestCase
{
    #[Test]
    public function it_will_return_403_on_unauthorized_scheduled_job_request()
    {
        $this->getJson('/gcr-worker/run-scheduled-job')
            ->assertStatus(403);
    }

    #[Test]
    public function it_can_handle_scheduled_job_invocation_as_expected()
    {
        config(['gcr-worker.allow_event_invocation' => true]);

        $this->getJson('/gcr-worker/run-scheduled-job')
            ->assertStatus(200)
            ->assertJsonFragment(['info' => 'The scheduled job has completed.']);
    }
}
