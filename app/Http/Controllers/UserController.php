<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        $response = Http::withToken(auth()->user()->api_token)->get(config('app.api_url') . '/users');

        if ($response->successful()) {
            $users = $response->json()['data'];
            return view('admin.users.index', compact('users'));
        }

        return back()->with('error', 'Unable to fetch users');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:user,constituency_admin,regional_admin,national_admin,super_admin',
            'region_id' => 'required|exists:regions,id',
            'constituency_id' => 'required|exists:constituencies,id',
        ]);

        // Set password to email
        $validated['password'] = Hash::make($validated['email']);

        $response = Http::withToken(auth()->user()->api_token)
            ->post(config('app.api_url') . '/users', $validated);

        if ($response->successful()) {
            return response()->json(['message' => 'User created successfully'], 201);
        }

        return response()->json(['message' => 'Failed to create user'], 400);
    }

    public function edit($id)
    {
        $response = Http::withToken(auth()->user()->api_token)->get(config('app.api_url') . '/users/' . $id);

        if ($response->successful()) {
            $user = $response->json()['data'];
            return view('admin.users.edit', compact('user'));
        }

        return back()->with('error', 'User not found');
    }

    public function update(Request $request, $id)
    {
        $response = Http::withToken(auth()->user()->api_token)
            ->put(config('app.api_url') . '/users/' . $id, $request->all());

        if ($response->successful()) {
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
        }

        return back()->withInput()->with('error', 'Failed to update user');
    }

    public function destroy($id)
    {
        $response = Http::withToken(auth()->user()->api_token)->delete(config('app.api_url') . '/users/' . $id);

        if ($response->successful()) {
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
        }

        return back()->with('error', 'Failed to delete user');
    }
}
