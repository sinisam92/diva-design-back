<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $token = auth()->attempt($credentials);
        if(!$token) {
            return response()->json([
                'message' => 'Please check credentials and try again.'
            ], 401);
        }
        return response()->json([
            'token' => $token,
            'type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
