<?php

// Auth Controller
use App\Http\Controllers\AuthController;

use App\Http\Controllers\CommentTaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('tasks',TaskController::class);
Route::apiResource('employees',EmployeeController::class);
Route::apiResource('task_statuses',TaskStatusController::class);
Route::apiResource('comment_tasks',CommentTaskController::class);

Route::get('task_statuses/{status}/task',[TaskStatusController::class,'taskByStatus']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
