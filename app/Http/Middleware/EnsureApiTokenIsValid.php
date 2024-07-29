<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info('EnsureApiTokenIsValid middleware called');

        if (!Session::has('api_token')) {
            Log::warning('No API token in session');
            return redirect()->route('login');
        }

        try {
            $response = Http::withToken(Session::get('api_token'))
                ->get(config('app.api_url') . '/user');

            if ($response->successful()) {
                Log::info('API token is valid');
                return $next($request);
            } else {
                Log::warning('Invalid API token', ['status' => $response->status()]);
                Session::forget(['user', 'api_token']);
                return redirect()->route('login');
            }
        } catch (\Exception $e) {
            Log::error('API token validation error', ['message' => $e->getMessage()]);
            Session::forget(['user', 'api_token']);
            return redirect()->route('login');
        }
    }
}
