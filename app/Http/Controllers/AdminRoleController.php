<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminRoleController extends Controller
{
    public function index()
    {
        try {
            $response = Http::withToken(auth()->user()->api_token)
                ->get(config('app.api_url') . '/admin-roles');
            
            if ($response->successful()) {
                $roles = $response->json()['data'];
                return view('admin.roles.index', compact('roles'));
            }
            
            return back()->with('error', 'Unable to fetch admin roles');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        try {
            $response = Http::withToken(auth()->user()->api_token)
                ->post(config('app.api_url') . '/admin-roles', $request->all());
            
            if ($response->successful()) {
                return redirect()->route('admin.roles.index')->with('success', 'Admin role created successfully');
            }
            
            return back()->withInput()->with('error', 'Failed to create admin role');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
