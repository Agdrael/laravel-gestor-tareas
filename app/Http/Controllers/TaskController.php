<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $tareas = [
            [
                'id' => 1,
                'titulo' => 'Aprender rutas',
                'completada' => true,
            ],
            [
                'id' => 2,
                'titulo' => 'Aprender controladores',
                'completada' => false,
            ],
        ];

        return view('tareas', [
            'tareas' => $tareas,
        ]);
    }
}