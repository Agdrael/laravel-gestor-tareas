<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar tarea</title>
</head>

<body>
    <h1>Editar tarea</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf
        @method('PATCH')

        <div>
            <label for="title">Título</label>

            <input id="title" name="title" type="text" value="{{ old('title', $task->title) }}">
        </div>

        <div>
            <label for="description">Descripción</label>

            <textarea id="description" name="description">{{ old('description', $task->description) }}</textarea>
        </div>

        <div>
            <label for="due_date">Fecha límite</label>

            <input id="due_date" name="due_date" type="date"
                value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">
        </div>

        <div>
            <input type="hidden" name="completed" value="0">

            <input id="completed" name="completed" type="checkbox" value="1" @checked(old('completed', $task->completed))>

            <label for="completed">Completada</label>
        </div>

        <button type="submit">Actualizar</button>
    </form>

    <a href="{{ route('tasks.show', $task) }}">
        Cancelar
    </a>
</body>

</html>
