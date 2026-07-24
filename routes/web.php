<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/saludo', function () {
    return "Yeellow desde laravel";
});

Route::get('/tareas',[TaskController::class,'index']);
