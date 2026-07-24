<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::latest()->get();

        return view('tareas', [
            'tasks' => $tasks,
        ]);
    }
}