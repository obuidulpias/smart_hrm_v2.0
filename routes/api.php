<?php

use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/logout', action: [AuthController::class, 'logout']);
    Route::get('/user', action: [AuthController::class, 'user']);

    //Employee Routes
    Route::get('/employee-list', [EmployeeController::class, 'list']);
    //Route::get('/employee-add', [EmployeeController::class, 'add']);
    Route::post('/employee-add', [EmployeeController::class, 'create']);


});


//Use for testing
Route::get('/test-orm', [TestController::class, 'testOrm']);

