<?php

// Auth Controller
use App\Http\Controllers\AuthController;

use App\Http\Controllers\CommentTaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Public Routes
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('auth/send-welcome-mail', [MailController::class, 'sendWelcomeMail']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::apiResource('tasks',TaskController::class);
    Route::apiResource('task_statuses',TaskStatusController::class);
    Route::apiResource('comment_tasks',CommentTaskController::class);
    Route::get('task_statuses/{status}/task', [TaskStatusController::class,'taskByStatus']);
    Route::get('employees/{employee}/task', [EmployeeController::class, 'taskByEmployee']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', [AuthController::class, 'me']);
    Route::post('auth/change-password', [AuthController::class, 'changePassword']);
    Route::post('auth/verify', [AuthController::class, 'verifyUser']);

    // Admin Routes
    Route::apiResource('employees',EmployeeController::class)->middleware('role:admin');
    Route::post('auth/register', [AuthController::class, 'register'])->middleware('role:admin');
});
