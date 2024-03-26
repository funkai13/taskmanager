<?php

// Auth Controller
use App\Http\Controllers\AuthController;

use App\Http\Controllers\CommentTaskController;
use App\Http\Controllers\EmployeeController;
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

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::apiResource('tasks',TaskController::class);
    Route::apiResource('task_statuses',TaskStatusController::class);
    Route::apiResource('comment_tasks',CommentTaskController::class);
    Route::get('task_statuses/{status}/task', [TaskStatusController::class,'taskByStatus']);

    // Admin Routes
    Route::apiResource('employees',EmployeeController::class)->middleware('role:admin');
    Route::post('auth/register', [AuthController::class, 'register'])->middleware('role:admin');
});
