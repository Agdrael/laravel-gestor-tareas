<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tareas</title>
</head>
<body>
    <h1>Gestor de tareas</h1>

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
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>