<?php

namespace RichanFongdasen\GCRWorker\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use RichanFongdasen\GCRWorker\PubSubEvent;
use RichanFongdasen\GCRWorker\Requests\PubSubEventRequest;

class PubSubEventController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * Handle Pub/Sub event invocation.
     *
     * @param \RichanFongdasen\GCRWorker\Requests\PubSubEventRequest $request
     * @param \RichanFongdasen\GCRWorker\PubSubEvent                 $event
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PubSubEventRequest $request, PubSubEvent $event): JsonResponse
    {
        $event->handle($request->getPubSubMessage());

        return response()->json(['info' => 'The Pub/Sub queued job has completed.']);
    }
}
