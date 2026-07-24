<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tareas</title>
</head>
<body>
    <h1>Gestor de tareas</h1>

    <ul>
        @foreach ($tareas as $tarea)
            <li>
                {{ $tarea['titulo'] }}

                @if ($tarea['completada'])
                    — Completada
                @else
                    — Pendiente
                @endif
            </li>
        @endforeach
    </ul>
</body>
</html>