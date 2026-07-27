<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/saludo', function () {
    return "Yeellow desde laravel";
});


Route::get('/tareas',[TaskController::class,'index'])->name('tasks.index');
Route::post('/tareas',[TaskController::class,'store'])->name('tasks.store');
Route::get('/tareas/crear',[TaskController::class,'create'])->name('tasks.create');
Route::get('/tareas/{task}',[TaskController::class,'show',])->name('tasks.show');
Route::get('/tareas/{task}/editar',[TaskController::class,'edit'])->name('tasks.edit');
Route::patch('/tareas/{task}',[TaskController::class,'update'])->name('tasks.update');
Route::delete('/tareas/{task}',[TaskController::class,'destroy'])->name('tasks.destroy');

