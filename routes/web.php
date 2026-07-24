<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/saludo', function () {
    return "Yeellow desde laravel";
});

Route::get('/tareas', function () {
    $tareas = [
        [
            'id'=>1,
            'titulo'=>'aprender rutas',
            'completada'=>true
        ],
        [
            'id'=>2,
            'titulo'=>'aprender controladores' ,
            'completada'=>false
        ],
    ];

    return view('tareas',[
        'tareas'=>$tareas,
    ]);
});
