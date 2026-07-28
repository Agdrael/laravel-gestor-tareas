<?php

use App\Models\Category;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('una tarea puede ser creada con una categoría válida', function () {
    // Arrange
    $category = Category::factory()->create();

    $data = [
        'category_id' => $category->id,
        'title' => 'Aprender pruebas en Laravel',
        'description' => 'Probar la creación de tareas',
        'completed' => false,
        'due_date' => '2026-08-15',
    ];

    // Act
    $response = $this->post(route('tasks.store'), $data);

    // Assert
    $response->assertSessionHasNoErrors();

    $this->assertDatabaseHas('tasks', [
        'category_id' => $category->id,
        'title' => 'Aprender pruebas en Laravel',
        'description' => 'Probar la creación de tareas',
    ]);

    $task = Task::query()
        ->with('category')
        ->where('title', 'Aprender pruebas en Laravel')
        ->firstOrFail();

    $this->assertFalse($task->completed);

    $this->assertSame(
        '2026-08-15',
        $task->due_date->toDateString()
    );

    $this->assertTrue(
        $task->category->is($category)
    );

    $response->assertRedirect(route('tasks.index'));
});

test('una tarea no puede ser creada con una categoria inexistente',function(){
    $data =[
        'category_id'=>99999,
        'title'=>'Tarea con categoria invalida',
        'description'=>'Esta tarea no debe guardarse',
        'completed'=>false,
        'due_date'=>'2025-08-15'
    ];

    $response = $this
        ->from(route('tasks.create'))
        ->post(route('tasks.store'),$data);

    $response->assertSessionHasErrors('category_id')
        ->assertRedirect(route('tasks.create'));

    $this->assertDataBaseCount('tasks',0);
});

test('una tarea no puede ser creada sin una categoria',function(){
    $data =[
        'title'=>'Tarea sin categoria',
        'description'=>'Esta tarea no debe guardarse',
        'completed'=> false,
        'due_date'=>'2026-08-15'
    ];

    $response = $this
        ->from(route('tasks.create'))
        ->post(route('tasks.store'),$data);

     $response->assertOnlyInvalid(['category_id'])
        ->assertRedirectToRoute('tasks.create');
    
    $this->assertDataBaseCount('tasks',0);
    
});
