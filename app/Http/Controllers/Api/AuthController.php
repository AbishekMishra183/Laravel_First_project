<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return response()->json(['message' => 'Test login']);
    }

    public function register(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|min:1|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Check if email already exists
        $existingUser = User::where('email', $request->email)->exists();
        if ($existingUser) {
            throw ValidationException::withMessages([
                'email' => ['Email already in use'],
            ]);
        }

        // Create the user with hashed password
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }

    public function logout(Request $request)
    {
        // Assuming you're using Sanctum or Passport:
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }
}
