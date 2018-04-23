<?php

namespace App\Http\Controllers;


use App\Employee;
use App\Http\Resources\EmployeeResource as EmployeeResource;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return EmployeeResource::collection(Employee::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $employee = $request->isMethod('put') ? Employee::findOrfail($request->id) : new Employee;

        $employee->id = $request->input('id');
        $employee->fullname = $request->input('fullname');
        $employee->nationality = $request->input('nationality');
        $employee->occupation = $request->input('occupation');

        if ($employee->save()) {
            return new EmployeeResource($employee);
        } else {
            //handle fail
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return new EmployeeResource(Employee::findOrfail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $employee = Employee::findOrfail($id);

        if ($employee->delete) {
            return new EmployeeResource($employee);
        } else {
            //handle fail
        }
        
    }
}
