<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear tarea</title>
</head>

<body>
    <h1>Crear tarea</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <div>
            <label for="title">Título</label>
            <input id="title" name="title" type="text" value="{{ old('title') }}">
        </div>

        <div>
            <label for="description">Descripción</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="due_date">Fecha límite</label>
            <input id="due_date" name="due_date" type="date" value="{{ old('due_date') }}">
        </div>

        <button type="submit">Guardar</button>
    </form>
</body>

</html>
