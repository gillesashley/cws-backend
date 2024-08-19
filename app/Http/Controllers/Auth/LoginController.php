<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        // $validEmails = [
        //     'constituency_admin@example.com',
        //     'regional_admin@example.com',
        //     'national_admin@example.com',
        //     'admin@example.com',
        //     'melody.jakubowski@example.com'
        $creds = $request->validate([
            'email' => 'exists:users,email',
            'password' => 'required|string|min:3'
        ]);


        $attempt = auth()->attempt($creds);
        $user = User::where('email', $creds['email'])->firstorfail();

        if ($attempt && $user->isAnyAdmin()) {
            $token = $user->createToken('auth_token')->plainTextToken;

            session(compact('user', 'token'));
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
