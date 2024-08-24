<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'date_of_birth' => 'required|date',
            'ghana_card_id' => 'required|string|unique:users',
            // 'ghana_card_image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'constituency_id' => 'required|exists:constituencies,id',
            'region_id' => 'required|exists:regions,id',
            'area' => 'required|string|max:255',
            'role' => [
                'sometimes',
                function ($attr, $value, $fail) {
                    $roles = explode(',', 'user,constituency_admin,regional_admin,national_admin,application_admin');
                    if (auth()->user()->isAnyAdmin() && !in_array($attr, $roles)) {
                        $fail("Error: $attr value invalid");
                    }
                }
            ],
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
            $user = User::create(['role' => 'user', 'ghana_card_image_path' => asset('assets/images/avatars/01.png')] + $validated);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 201);
        } catch (Exception $e) {
            // If user creation fails, delete the uploaded image
            if (isset($validated['ghana_card_image_path'])) {
                Storage::disk('public')->delete($validated['ghana_card_image_path']);
            }

            return response()->json(['message' => 'Registration failed: ' . $e->getMessage()], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid login credentials'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ]);
    }

    public function checkPhoneAvailability(Request $request): JsonResponse
    {
        $request->validate(['phone' => 'required|string']);
        $exists = User::where('phone', $request->phone)->exists();
        return response()->json(['available' => !$exists]);
    }
}
