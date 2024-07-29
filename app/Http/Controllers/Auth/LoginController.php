<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

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

                Session::put('user', $userData['user']);
                Session::put('access_token', $userData['token']);

                Log::info('Access token stored in session', ['token' => $userData['token']]);

                return redirect()->route('dashboard')->with('status', 'Logged in successfully!');
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
            $response = Http::withToken(Session::get('access_token'))
                ->post(config('app.api_url') . '/logout');

            if (!$response->successful()) {
                Log::warning('Logout API call failed', ['response' => $response->json()]);
            }
        } catch (\Exception $e) {
            Log::error('Logout error', ['message' => $e->getMessage()]);
        }

        // Clear the session
        Session::forget(['user', 'access_token']);

        // Redirect to the login page
        return redirect()->route('login');
    }
}
