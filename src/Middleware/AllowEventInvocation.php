<?php

namespace RichanFongdasen\GCRWorker\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowEventInvocation
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (config('gcr-worker.allow_event_invocation') !== true) {
            abort(403, 'The event invocation is not enabled in this service / application.');
        }

        return $next($request);
    }
}
