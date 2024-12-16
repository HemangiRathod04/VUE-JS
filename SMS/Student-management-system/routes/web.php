<?php

use App\Http\Controllers\TeachersController;
use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('welcome');
})->where('any','.*');

