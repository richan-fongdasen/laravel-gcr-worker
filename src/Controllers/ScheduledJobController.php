<?php

namespace RichanFongdasen\GCRWorker\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;

class ScheduledJobController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * Increase the max execution time when handling a queued job.
     */
    protected function increaseExecutionTime(): void
    {
        ini_set('max_execution_time', 0);
        set_time_limit(0);
    }

    /**
     * Increase the memory limit when handling a queued job.
     */
    protected function increaseMemoryLimit(): void
    {
        ini_set('memory_limit', '-1');
    }

    /**
     * Handle scheduled job event invocation.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $this->increaseExecutionTime();
        $this->increaseMemoryLimit();

        Artisan::call('schedule:run');

        $response = [
            'info'   => 'The scheduled job has completed.',
        ];

        return response()->json($reponse);
    }
}
