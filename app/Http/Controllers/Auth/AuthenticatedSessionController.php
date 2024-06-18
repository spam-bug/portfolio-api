<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }

        return response()->json([
            'data' => [
                'user' => Auth::user(),
            ],
            'access_token' => Auth::user()->createToken('authentication')->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Log out success']);
    }
}
