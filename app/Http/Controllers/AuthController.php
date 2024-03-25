<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request) {
        $validator = Validator::make($request -> all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator -> fails()) {
            return response() -> json($validator -> errors());
        }

        $data = $validator->getData();
        $userData = array_merge($data, ['role' => $data['role'] ?? 'employee']);

        $user = User::create($userData);

        $token = $user -> createToken('auth_token') -> plainTextToken;

        return response() -> json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
}
