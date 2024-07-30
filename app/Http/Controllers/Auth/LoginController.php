<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $validEmails = [
            'constituency_admin@example.com',
            'regional_admin@example.com',
            'national_admin@example.com',
            'admin@example.com',
            'melody.jakubowski@example.com'
        ];

        if (in_array($request->email, $validEmails) && $request->password === 'password') {
            $user = (object)[
                'email' => $request->email,
                'name' => explode('@', $request->email)[0],
                'role' => strpos($request->email, 'admin') !== false ? 'admin' : 'user'
            ];
            session(['user' => $user]);
            return redirect('/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        session()->forget('user');
        return redirect()->route('login');
    }
}
