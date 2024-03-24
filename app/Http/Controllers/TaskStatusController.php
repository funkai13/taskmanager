<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $taskstatus = TaskStatus::all();
            return ApiResponse::success('Taskstatus list',200,$taskstatus);

        }catch (Exception $e) {
            return  ApiResponse::error('Error getting taskstatus list',500); 
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name', 
                'description', 
                'created_by', 
                'active',
                
            ]);
            $taskstatus = TaskStatus::create($request->all());
           return ApiResponse::success('task status Create',201,$taskstatus);

        } catch (ValidationException $e) {
            return ApiResponse:: error('validation error',422,);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskStatus $taskStatus)
    {
        return $taskStatus;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try {
            $taskstatus = TaskStatus::findOrFail($id);
            $request->validate([
                'name', 
                'description', 
                'created_by', 
                'active',
                
            ]);
            $taskstatus ->update($request->all());
        } catch (ValidationException $e) {
             return ApiResponse:: error('validation error',422,);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try {
            $taskstatus = TaskStatus::findOrFail($id);
            $taskstatus->delete();
            return ApiResponse::success('Deleted TaskStatus');
        } catch (Exception $e) {
            return ApiResponse::error('TaskStatus not found',404);
        }
    }
}
