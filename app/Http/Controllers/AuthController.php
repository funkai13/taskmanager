<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $data = $validator->getData();
        $userData = array_merge($data, ['role' => $data['role'] ?? 'employee']);

        $user = User::create($userData);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $data = $validator->getData();
        $user = User::where('name', $data['name'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'error' => true,
                'message' => 'Wrong credentials'
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'role' => $user->role
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'Logged out it\'s ok'
        ]);
    }
}
