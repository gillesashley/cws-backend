<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use App\Models\Constituency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['region', 'constituency'])
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $regions = Region::all();
        $constituencies = Constituency::all();
        return view('admin.users.create', [
            'regions' => $regions,
            'constituencies' => $constituencies
        ]);
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

        $validated['password'] = Hash::make($validated['email']);

        try {
            User::create($validated);
            return redirect()->route('admin.users.index')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            Log::error('Error creating user', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'An error occurred while creating the user. Please try again.');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $regions = Region::all();
        $constituencies = Constituency::all();
        return view('admin.users.edit', compact('user', 'regions', 'constituencies'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:user,constituency_admin,regional_admin,national_admin,super_admin',
            'region_id' => 'required|exists:regions,id',
            'constituency_id' => 'required|exists:constituencies,id',
        ]);

        try {
            $user->update($validated);
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating user', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'An error occurred while updating the user. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting user', ['error' => $e->getMessage()]);
            return back()->with('error', 'An error occurred while deleting the user. Please try again.');
        }
    }
}
