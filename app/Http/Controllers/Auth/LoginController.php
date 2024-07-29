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

                // Store user data and token in session
                Session::put('user', $userData['user']);
                Session::put('api_token', $userData['token']);

                return redirect()->intended('dashboard');
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
        Http::withToken(Session::get('api_token'))->post(config('app.api_url') . '/logout');

        Session::forget(['user', 'api_token']);

        return redirect('/');
    }
}
