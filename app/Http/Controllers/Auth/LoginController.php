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

                // Save user data to session or do necessary actions
                session(['user' => $userData['user']]);

                return redirect()->route('dashboard')->with('status', 'Logged in successfully!');
            } else {
                $responseBody = $response->json();
                Log::warning('Login failed', ['errors' => $responseBody]);
                return back()->withErrors(['email' => $responseBody['message'] ?? 'The provided credentials do not match our records.'])->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Login error', ['message' => $e->getMessage()]);
            return back()->withErrors(['email' => 'An error occurred during login. Please try again.'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        return redirect()->route('login');
    }
}
