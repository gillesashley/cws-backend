<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use App\Models\Constituency;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index(Request $request): View|Factory|Application
    {
        $userRoles = $request->get('userRoles', null);
        // $users = User::with(['region', 'constituency'])->when($userRoles, fn($q) => $q->whereIn('role', $userRoles))->paginate(15);
        $users = QueryBuilder::for(User::class)->allowedFilters([
            AllowedFilter::exact('constituency_id'),
            AllowedFilter::exact('region_id'),
        ])->paginate()->appends(request()->query());
        $regions = Region::all();
        $constituencies = Constituency::get();
        return view('admin.users.index', compact('users', 'regions', 'constituencies', 'userRoles'));
    }

    public function create(): View|Factory|Application
    {
        $regions = Region::all();
        $constituencies = Constituency::all();
        Log::info('Regions:', ['regions' => $regions]);
        Log::info('Constituencies:', ['constituencies' => $constituencies]);
        return view('admin.users.create', compact('regions', 'constituencies'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:user,constituency_admin,regional_admin,national_admin,application_admin',
            'region_id' => 'required|exists:regions,id',
            'constituency_id' => 'required|exists:constituencies,id',
        ]);

        $validated['password'] = Hash::make($validated['email']);

        try {
            User::create($validated);
            return redirect()->route('admin.users.index')->with('success', 'User created successfully');
        } catch (Exception $e) {
            Log::error('Error creating user', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'An error occurred while creating the user. Please try again.');
        }
    }

    public function edit($id): View|Factory|Application
    {
        $user = User::findOrFail($id);
        $regions = Region::all();
        $constituencies = Constituency::all();
        return view('admin.users.edit', compact('user', 'regions', 'constituencies'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:user,constituency_admin,regional_admin,national_admin,application_admin',
            'region_id' => 'required|exists:regions,id',
            'constituency_id' => 'required|exists:constituencies,id',
        ]);

        try {
            $user->update($validated);
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
        } catch (Exception $e) {
            Log::error('Error updating user', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'An error occurred while updating the user. Please try again.');
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
        } catch (Exception $e) {
            Log::error('Error deleting user', ['error' => $e->getMessage()]);
            return back()->with('error', 'An error occurred while deleting the user. Please try again.');
        }
    }
}
