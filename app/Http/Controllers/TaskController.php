<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
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

    public function create(): View
    {
        return view('tareas-create');
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        Task::create($request->validated());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarea creada correctamente.');
    }

    public function show(Task $task): View
    {
        return view('tareas-show', [
            'task' => $task
        ]);
    }

    public function edit(Task $task): View
    {
        return view('tareas-edit', [
            'task' => $task,
        ]);
    }

    public function update(
        UpdateTaskRequest $request,
        Task $task
    ): RedirectResponse {
        $task->update($request->validated());

        return redirect()
            ->route('tasks.show',$task)
            ->with('success','Tarea actualizada correctamente');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect()
            ->route('tasks.index')
            ->with('success','Tarea eliminada correctamente.');
    }
}
