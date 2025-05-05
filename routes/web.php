<?php

use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('api')->prefix('api')->group(function () {
    Route::apiResource('employees', EmployeeController::class);
});
