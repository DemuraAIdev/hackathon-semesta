<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $input = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'string|required'
        ]);

        if ($input->fails()) {
            return response()->json([
                'status' => 422,
                'mesaage' => 'invalid input'
            ], 422);
        }

        if (!$token = JWTAuth::attempt($input->validate())) {
            return response()->json([
                'status' => 401,
                'message' => 'invalid credentials'
            ], 422);
        }

        return response()->json([
            'status' => 200,
            'message' => 'successfully login',
            'token' => $token
        ], 200);

    }

    public function me()
    {
        return response()->json([
            'status' => 200,
            'message' => 'success retrive user data',
            'data' => auth()->user(),
            'role' => auth()->user()->getRoleNames()
        ], 200);
    }
}
