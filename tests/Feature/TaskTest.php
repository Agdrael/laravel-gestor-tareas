<?php

use App\Models\Category;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('una tarea no puede ser creada con una categoria invalida',function(?int $categoryId){
    $data = [
        'category_id'=>$categoryId,
        'title'=>'Tarea con categoria invalida',
        'description'=>'Esta tarea no debe guardarse',
        'completed'=>false,
        'due_date'=>now()->addMonth()->toDateString(),
    ];

    $response = $this
        ->from(route('tasks.create'))
        ->post(route('tasks.store'),$data);

    $response
        ->assertOnlyInvalid(['category_id'])
        ->assertRedirectToRoute('tasks.create');

    $this->assertDatabaseCount('tasks',0);
})->with([
    'la categoria es obligatoria'=>[null],
    'la categoria no existe'=>[99999]
]);

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
    
    $this->assertDatabaseCount('tasks',0);
    
});
