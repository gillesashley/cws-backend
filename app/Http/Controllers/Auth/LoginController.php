<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            $response = Http::post(config('app.api_url') . '/login', $credentials);

            if ($response->successful()) {
                $userData = $response->json();
                Log::info('Login successful', ['user' => $userData['user']['email']]);

                // Generate a new API token
                $token = Str::random(80);
                $hashedToken = hash('sha256', $token);

                // Update the user's API token in the database
                $updateTokenResponse = Http::withToken($userData['token'])
                    ->put(config('app.api_url') . '/users/' . $userData['user']['id'], [
                        'api_token' => $hashedToken,
                    ]);

                if ($updateTokenResponse->successful()) {
                    // Store the new token in the session
                    Session::put('user', $userData['user']);
                    Session::put('api_token', $token);

                    Log::info('API token updated successfully');
                    Log::info('Attempting to redirect to dashboard');
                    return redirect()->route('dashboard')->with('status', 'Logged in successfully!');
                } else {
                    Log::error('Failed to update API token', ['response' => $updateTokenResponse->json()]);
                    return back()->withErrors(['email' => 'An error occurred during login. Please try again.'])->withInput();
                }
            } else {
                Log::warning('Login failed', ['errors' => $response->json()]);
                return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Login error', ['message' => $e->getMessage()]);
            return back()->withErrors(['email' => 'An error occurred during login. Please try again.'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        try {
            // Call your API to invalidate the token
            $response = Http::withToken(Session::get('api_token'))
                ->post(config('app.api_url') . '/logout');

            if (!$response->successful()) {
                Log::warning('Logout API call failed', ['response' => $response->json()]);
            }
        } catch (\Exception $e) {
            Log::error('Logout error', ['message' => $e->getMessage()]);
        }

        // Clear the session
        Session::forget(['user', 'api_token']);

        // Redirect to the login page
        return redirect()->route('login');
    }
}
