<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('login','UserController@login');
Route::post('UserRegistration','UserController@UserRegistration');

Route::post('/logout', 'UserControler@logout')->middleware('auth:api');


// Route::resource('employ', 'UserController');
Route::get('designation', 'UserController@design');

Route::get('resours', 'UserController@resours');

Route::get('designationPagination', 'DesignationController@pagination');

Route::post('attendancePagination', 'AttendanceController@pagination');
Route::post('test', 'AttendanceController@test');
Route::post('present', 'AttendanceController@present');

Route::post('todayPresent', 'AttendanceController@todayPresent');
Route::post('getToday', 'AttendanceController@getToday');

Route::middleware('auth:api')->group(function () {
    Route::get('self', 'UserController@self');


    Route::get('employee','UserController@index');
    Route::get('index', 'UserController@index');
    Route::post('addEmployee', 'UserController@addEmployee');
    Route::put('editEmployee/{id}', 'UserController@editEmployee');
    Route::put('editEmployeenoPic/{id}', 'UserController@editEmployeenoPic');
    Route::delete('deleteEmployee/{id}', 'UserController@destroyEmployee');
    Route::post('searchEmployee', 'UserController@search');
    Route::get('users/pagination','UserController@pagination');
    Route::get('countAll','UserController@countAll');
    Route::get('departmentIndex', 'DepartmentController@index');

    Route::post('searchDepartment', 'DepartmentController@search');
    Route::get('departmentPagination', 'DepartmentController@pagination');

    Route::post('searchDesignation', 'DesignationController@search');
    Route::get('getAll', 'DesignationController@getAll');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


