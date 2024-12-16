<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/logout', [AuthController::class, 'logout'])->name('post.logout');
Route::get('/roles', [RoleController::class, 'roles'])->name('get.roles');
Route::post('/role/{id}', [RoleController::class, 'role'])->name('get.role');  ///update the role

Route::get('/role/show/{id}/permissions', [RoleController::class, 'rolePermissions'])->name('get.role');  //add role permission.
Route::post('/permissions/update', [RoleController::class, 'Update'])->name('get.permissions');


Route::prefix('user')->group(function(){
    Route::get('/index',[UserController::class,'index'])->name('get.users');
});

