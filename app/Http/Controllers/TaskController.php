<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
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
        $categories = Category::query()
            ->orderBy('name','asc')
            ->get(['id','name']);

        return view('tareas-create',[
            'categories'=>$categories
        ]);
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
        $task->load('category');

        return view('tareas-show', [
            'task' => $task
        ]);
    }

    public function edit(Task $task): View
    {
        $categories = Category::query()
            ->orderBy('name','asc')
            ->get(['id','name']);

        return view('tareas-edit', [
            'task' => $task,
            'categories'=>$categories
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
