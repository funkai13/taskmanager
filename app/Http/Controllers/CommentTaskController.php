<?php

namespace App\Http\Controllers;

use App\Models\CommentTask;
use App\Http\Requests\StoreCommentTaskRequest;
use App\Http\Requests\UpdateCommentTaskRequest;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class CommentTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $commenttask = CommentTask::all();
            return ApiResponse::success('commentTask list',200,$commenttask);

        }catch (Exception $e) {
            return  ApiResponse::error('Error getting commenttask list',500); 
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
                'task_id'=>'required|exists:tasks,id', 
                'comment'=> 'required', 
                'active'=>'required', 
                'created_by' =>'required', 
                
            ]);
            $commenttask = CommentTask::create($request->all());
           return ApiResponse::success('Comment created',201,$commenttask);

        } catch (ValidationException $e) {
            return ApiResponse:: error('validation error',422,);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CommentTask $commentTask)
    {
        return $commentTask;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommentTask $commentTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try {
            $commenttask = CommentTask::findOrFail($id);
            $request->validate([
                'task_id'=>'required|exists:tasks,id', 
                'comment'=> 'required', 
                'active'=>'required', 
                'created_by' =>'required', 
                
            ]);
            $commenttask ->update($request->all());
            return ApiResponse::success('Update Comment Succes',200);
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
            $commenttask = CommentTask::findOrFail($id);
            $commenttask->delete();
        } catch (Exception $e) {
            return ApiResponse::error('Comment not found',404);
        }
    }
}
