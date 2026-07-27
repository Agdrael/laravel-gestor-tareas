<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/saludo', function () {
    return "Yeellow desde laravel";
});

Route::resource('tareas', TaskController::class)
    ->parameters([
        'tareas'=>'task',
    ])
    ->names([
        'index'=>'tasks.index',
        'create'=>'tasks.create',
        'store'=>'tasks.store',
        'show'=>'tasks.show',
        'edit'=>'tasks.edit',
        'update'=>'tasks.update',
        'destroy'=>'tasks.destroy',
    ]);


