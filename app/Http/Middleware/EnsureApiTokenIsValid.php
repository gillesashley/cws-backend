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

        $token = Session::get('access_token');

        if (!$token) {
            Log::warning('No access token found in session');
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        try {
            $response = Http::withToken($token)->get(config('app.api_url') . '/user');

            if ($response->successful()) {
                Log::info('API token is valid');
                // Refresh the user data in the session
                Session::put('user', $response->json());
                return $next($request);
            } else {
                Log::warning('API token is invalid', ['status' => $response->status()]);
                Session::forget(['user', 'access_token']);
                return redirect()->route('login')->with('error', 'Your session has expired. Please log in again.');
            }
        } catch (\Exception $e) {
            Log::error('Error validating API token', ['error' => $e->getMessage()]);
            Session::forget(['user', 'access_token']);
            return redirect()->route('login')->with('error', 'An error occurred. Please log in again.');
        }
    }
}
