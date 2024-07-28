<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        $response = Http::post(config('app.api_url') . '/login', $credentials);

        if ($response->successful()) {
            $user = $response->json()['user'];
            $token = $response->json()['token'];

            // Store user data and token in session
            session(['user' => $user, 'api_token' => $token]);

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Call logout API endpoint
        Http::withToken(session('api_token'))->post(config('app.api_url') . '/logout');

        // Clear session data
        $request->session()->forget(['user', 'api_token']);

        return redirect('/');
    }
}
