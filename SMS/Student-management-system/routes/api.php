<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeachersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register/store',[AuthController::class,'store']);

Route::get('/teachers',[TeachersController::class,'index']);
Route::post('/teachers/store',[TeachersController::class,'store']);
Route::get('/teachers/edit/{id}',[TeachersController::class,'edit']);
Route::post('/teachers/update/{id}',[TeachersController::class,'update']);

Route::get('/students',[StudentController::class,'index']);
Route::post('/students/view/{id}',[StudentController::class,'view']);
Route::get('/students/class',[StudentController::class,'studentClasses']);
Route::post('/students/store',[StudentController::class,'store']);
Route::get('/students/edit/{id}',[StudentController::class,'edit']);
Route::post('/students/update/{id}',[StudentController::class,'update']);

Route::get('/schedules',[SchedulesController::class,'index']);
Route::post('/schedules/store',[SchedulesController::class,'store']);

Route::get('/classes',[ClassesController::class,'index']);
Route::post('/classes/store',[ClassesController::class,'store']);
Route::post('/classes/update/{id}',[ClassesController::class,'update']);






