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

        <div>
            <label for="category_id">Categoría</label>

            <select id="category_id" name="category_id">
                <option value="">Selecciona una categoría</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) old('category_id') === (string) $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Guardar</button>
    </form>
</body>

</html>
