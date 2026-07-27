<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tareas</title>
</head>

<body>
    <a href="{{ route('tasks.create') }}">Crear tarea</a>
    <h1>Gestor de tareas</h1>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif



    @if ($tasks->isEmpty())
        <p>No hay tareas registradas.</p>
    @else
        <ul>
            @foreach ($tasks as $task)
                <li>
                    {{ $task->title }}

                    @if ($task->completed)
                        — Completada
                    @else
                        — Pendiente
                    @endif

                    @if ($task->due_date)
                        — Vence: {{ $task->due_date->format('d/m/Y') }}
                    @endif
                    <a href="{{ route('tasks.show', $task) }}">
                        Ver
                    </a>
                    <a href="{{ route('tasks.edit', $task) }}">
                        Editar
                    </a>
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
                            Eliminar
                        </button>
                    </form>

                </li>
            @endforeach
        </ul>
    @endif
</body>

</html>
