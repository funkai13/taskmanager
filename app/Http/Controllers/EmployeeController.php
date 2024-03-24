<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Exception;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $employee = Employee::all();
            return ApiResponse::success('Employees list',200,$employee);

        }catch (Exception $e) {
            return  ApiResponse::error('Error getting employees list',500); 
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
                'user_id'=>'required|exists:users,id', 
                'name'=>'required', 
                'code'=> 'required', 
                'created_by' =>'required', 
                'active'=>'required',
            ]);
            $employee = Employee::create($request->all());
           return ApiResponse::success('employee created',201,$employee);

        } catch (ValidationException $e) {
            return ApiResponse:: error('validation error',422,);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return $employee;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $request->validate([
                'user_id'=>'required|unique:employees|exists:users,id', 
                'name'=>'required|unique:employees', 
                'code'=> 'required', 
                'created_by' =>'required', 
                'active'=>'required',
            ]);
            $employee ->update($request->all());
            return ApiResponse::success('Update Employee Succes',200);
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
            $employee = Employee::findOrFail($id);
            $employee->delete();
            return ApiResponse::success('Deleted Employee');
        } catch (Exception $e) {
            return ApiResponse::error('Employee not found',404);
        }
    }
}
