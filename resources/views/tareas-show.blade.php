<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>{{ $task->title }}</title>
</head>

<body>
    <h1>{{ $task->title }}</h1>

    <p>
        {{ $task->description ?? 'Sin descripción.' }}
    </p>

    <p>
        Estado: {{ $task->completed ? 'Completada' : 'Pendiente' }}
    </p>

    @if ($task->due_date)
        <p>Fecha límite: {{ $task->due_date->format('d/m/Y') }}</p>
    @endif

    <a href="{{ route('tasks.index') }}">Volver al listado</a>
</body>

</html>
