<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tasks = Task::all();
            return ApiResponse::success('Task list',200,$tasks);

        }catch (Exception $e) {
            return  ApiResponse::error('Error getting task list',500); 
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
                'status_id'=>'required|exists:task_statuses,id', 
                'employee_id'=> 'required|exists:employees,id', 
                'title'=>'required', 
                'description'=> 'required', 
                'created_by' =>'required', 
                
            ]);
            $task = Task::create($request->all());
           return ApiResponse::success('task created',201,$task);

        } catch (ValidationException $e) {
            return ApiResponse:: error('validation error',422,);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try {
            $task = Task::findOrFail($id);
            $request->validate([
                'status_id'=>'required|exists:task_statuses,id', 
                'employee_id'=> 'required|exists:employees,id', 
                'title'=>'required', 
                'description'=> 'required', 
                'created_by' =>'required', 
                
            ]);
            $task ->update($request->all());
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
            $task = Task::findOrFail($id);
            $task->delete();
            return ApiResponse::success('Deleted Task');
        } catch (Exception $e) {
            return ApiResponse::error('Task not found',404);
        }
    }
}
