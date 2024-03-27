<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Mail\Welcome;
use App\Models\Employee;
use DateTime;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    public function register(Request $request): JsonResponse
    {
        try {
            $loggedUser = $request->user();

            $employeeValidator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'second_name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'second_surname' => 'required|string|max:255',
            ]);

            $userValidator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255|unique:users',
            ]);

            if ($employeeValidator->fails()) {
                return response()->json($employeeValidator->errors());
            }
            if ($userValidator->fails()) {
                return response()->json($userValidator->errors());
            }

            $data = $userValidator->getData();

            $userData = array_merge($data, ['role' => $data['role'] ?? 'employee']);
            $employeeData = $employeeValidator->getData();
            $strPassword = Str::random(8);
            $password = bcrypt($strPassword);

            $userData['password'] = $password;
            $userData['name'] =
                mb_substr($employeeData['name'], 0, 1) .
                mb_substr($employeeData['second_name'], 0, 1) .
                $employeeData['surname'];
            $userData['created_by'] = $loggedUser->id;
            $user = User::create($userData);

            $employeeData['user_id'] = $user->id;
            $employeeData['code'] = 'EMP_' . $user->id;
            $employeeData['created_by'] = $loggedUser->id;
            $employee = Employee::create($employeeData);

            event(new Registered($user));
            $token = $user->createToken('auth_token')->plainTextToken;

            Mail::to($user->email)->send(new Welcome());

            return response()->json([
                'user' => $user,
                'employee' => $employee,
                'password' => $strPassword,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);
        } catch (\Exception $exception) {
            return ApiResponse::error("Error when created user and employee", 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $data = $validator->getData();
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return ApiResponse::error('Wrong credentials', 500);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'role' => $user->role
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return ApiResponse::success('Logged out it\'s ok');
    }

    public function forgotPassword(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function me(Request $request): JsonResponse
    {
        $user = User::with('employee')->findOrFail($request->user()->id);

        return response()->json([
            'user'=> $user
        ]);
    }

    public function verifyUser(Request $request): JsonResponse
    {
        $request->validate(['password' => 'required']);

        $user = $request->user();

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['email_verified_at'] = new DateTime();

        $user->update($data);
        $user->markEmailAsVerified();
        event(new Verified($user));
        return ApiResponse::success("User verified");
    }

    public function changePassword(Request $request): JsonResponse
    {
        try {
            $request->validate(['password' => 'required']);

            $user = $request->user();

            $data = $request->all();
            $data['password'] = bcrypt($data['password']);

            $user->update($data);
            return ApiResponse::success("User verified");
        } catch (\Exception $exception) {
            return ApiResponse::error('Error when change password', 500);
        }
    }
}
