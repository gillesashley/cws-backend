<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8',
            'date_of_birth' => 'required|date',
            'ghana_card_id' => 'required|string|unique:users',
            'ghana_card_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'constituency_id' => 'required|exists:constituencies,id',
            'region_id' => 'required|exists:regions,id',
            'area' => 'required|string|max:255',
            'role' => 'required|in:user,constituency_admin,regional_admin,national_admin,super_admin',
        ]);

        // Handle file upload
        if ($request->hasFile('ghana_card_image')) {
            $path = $request->file('ghana_card_image')->store('ghana_cards', 'public');
            $validated['ghana_card_image_path'] = $path;
        } else {
            return response()->json(['message' => 'Ghana Card image is required'], 422);
        }

        // Hash the password
        $validated['password'] = Hash::make($validated['password']);

        // Remove ghana_card_image from validated data as it's not a column in the users table
        unset($validated['ghana_card_image']);

        try {
            $user = User::create($validated);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 201);
        } catch (\Exception $e) {
            // If user creation fails, delete the uploaded image
            if (isset($validated['ghana_card_image_path'])) {
                Storage::disk('public')->delete($validated['ghana_card_image_path']);
            }

            return response()->json(['message' => 'Registration failed: ' . $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Instead of creating a token, we're using the session
        $request->session()->regenerate();

        return response()->json([
            'user' => $user,
        ]);
    }


    public function checkPhoneAvailability(Request $request)
    {
        $request->validate(['phone' => 'required|string']);
        $exists = User::where('phone', $request->phone)->exists();
        return response()->json(['available' => !$exists]);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
