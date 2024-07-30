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
        try {
            $response = Http::withCookies()->get(config('app.api_url') . '/user');

            if ($response->successful()) {
                Log::info('User is authenticated');
                return $next($request);
            } else {
                Log::warning('User is not authenticated', ['status' => $response->status()]);
                return redirect()->route('login')->with('error', 'Please log in to access this page.');
            }
        } catch (\Exception $e) {
            Log::error('Error checking authentication', ['error' => $e->getMessage()]);
            return redirect()->route('login')->with('error', 'An error occurred. Please log in again.');
        }
    }
}
