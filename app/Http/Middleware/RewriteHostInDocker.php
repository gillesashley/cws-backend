<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RewriteHostInDocker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $api_url = config('app.docker_api_url', config('app.api_url'));
        Log::info('rewritehostname', compact('api_url'));
        debug(compact('api_url'));
        config(['app.api_url' => $api_url]);
        return $next($request);
    }
}
