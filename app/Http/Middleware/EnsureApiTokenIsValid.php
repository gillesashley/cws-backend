<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('api_token')) {
            return redirect('login');
        }

        $response = Http::withToken(session('api_token'))
            ->get(config('app.api_url') . '/user');

        if ($response->successful()) {
            return $next($request);
        }

        return redirect('login');
        // return $next($request);
    }
}
