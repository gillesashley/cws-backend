<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // UserController.php
    public function index(Request $request)
    {
        Log::info('UserController index method called');

        $token = Session::get('access_token');

        if (!$token) {
            Log::warning('No access token found in UserController');
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        $page = $request->query('page', 1); // Get current page from request, default to 1
        $perPage = 15; // Set the number of items per page

        try {
            $response = Http::withToken($token)->get(config('app.api_url') . '/users', [
                'page' => $page,
                'per_page' => $perPage,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $users = collect($data['data']);
                $pagination = $data['meta']['pagination'] ?? null;

                // Map users to include relationships
                $users = $users->map(function ($user) {
                    $user['region'] = $user['region']['name'] ?? 'N/A';
                    $user['constituency'] = $user['constituency']['name'] ?? 'N/A';
                    return $user;
                });

                // Create a custom paginator
                $users = new \Illuminate\Pagination\LengthAwarePaginator(
                    $users,
                    $pagination['total'] ?? $users->count(),
                    $pagination['per_page'] ?? $perPage,
                    $pagination['current_page'] ?? $page,
                    ['path' => $request->url(), 'query' => $request->query()]
                );

                return view('admin.users.index', compact('users'));
            } else {
                Log::warning('Failed to fetch users', ['status' => $response->status()]);
                return back()->with('error', 'Unable to fetch users. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('Error fetching users', ['error' => $e->getMessage()]);
            return back()->with('error', 'An error occurred while fetching users. Please try again.');
        }
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
