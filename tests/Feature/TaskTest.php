<?php

use App\Models\Category;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('una tarea no puede ser creada con una categoria invalida', function (?int $categoryId) {
    $data = [
        'category_id' => $categoryId,
        'title' => 'Tarea con categoria invalida',
        'description' => 'Esta tarea no debe guardarse',
        'completed' => false,
        'due_date' => now()->addMonth()->toDateString(),
    ];

    $response = $this
        ->from(route('tasks.create'))
        ->post(route('tasks.store'), $data);

    $response
        ->assertOnlyInvalid(['category_id'])
        ->assertRedirectToRoute('tasks.create');

    $this->assertDatabaseCount('tasks', 0);
})->with([
    'la categoria es obligatoria' => [null],
    'la categoria no existe' => [99999]
]);

test('una tarea no puede ser creada sin una categoria', function () {
    $data = [
        'title' => 'Tarea sin categoria',
        'description' => 'Esta tarea no debe guardarse',
        'completed' => false,
        'due_date' => '2026-08-15'
    ];

    $response = $this
        ->from(route('tasks.create'))
        ->post(route('tasks.store'), $data);

    $response->assertOnlyInvalid(['category_id'])
        ->assertRedirectToRoute('tasks.create');

    $this->assertDatabaseCount('tasks', 0);
});

test('una tarea puede ser actualizada', function () {
    // Arrange
    $originalCategory = Category::factory()->create();
    $newCategory = Category::factory()->create();

    $task = Task::factory()
        ->for($originalCategory, 'category')
        ->create([
            'title' => 'Título original',
            'description' => 'Descripción original',
            'completed' => false,
            'due_date' => now()->addMonth()->toDateString(),
        ]);

    $data = [
        'category_id' => $newCategory->id,
        'title' => 'Título actualizado',
        'description' => 'Descripción actualizada',
        'completed' => true,
        'due_date' => now()->addMonths(2)->toDateString(),
    ];

    // Act
    $response = $this->put(
        route('tasks.update', $task),
        $data
    );

    // Assert: respuesta HTTP
    $response
    ->assertSessionHasNoErrors()
    ->assertRedirect(route('tasks.show', $task));

    // Assert: persistencia
    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'category_id' => $newCategory->id,
        'title' => 'Título actualizado',
        'description' => 'Descripción actualizada',
    ]);

    // Volver a consultar los datos actualizados
    $task->refresh()->load('category');

    // Assert: casts y relación
    $this->assertTrue($task->completed);

    $this->assertSame(
        now()->addMonths(2)->toDateString(),
        $task->due_date->toDateString()
    );

    $this->assertTrue(
        $task->category->is($newCategory)
    );
}); 