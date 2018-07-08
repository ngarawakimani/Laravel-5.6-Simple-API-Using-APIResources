<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//get all employees
Route::get('/employees', 'EmployeeController@index');

//get one employee
Route::get('/employee/{id}', 'EmployeeController@show');

//create one employee
Route::post('/employee', 'EmployeeController@store');

//update an employee
Route::put('/employee', 'EmployeeController@store');

//delete an employee
Route::delete('/employee/{id}', 'EmployeeController@destroy');