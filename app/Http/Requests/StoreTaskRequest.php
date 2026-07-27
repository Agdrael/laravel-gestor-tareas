<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>['required','string','max:255'],
            'description'=>['nullable','string'],
            'due_date'=>['nullable','date'],
            'category_id'=>['required','integer','exists:categories,id']
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'=>'El titulo es obligatorio',
            'title.string'=>'El titulo debe de ser texto',
            'title.max'=>'El titulo no debe de tener más de 255 caracteres',
            'description.string'=>'La descipcion debe de ser texto',
            'due_date.date'=>'La fecha límite debe ser una fecha valida',
            ''
        ];
    }

    public function attributes():array
    {
        return[
            'title'=>'titulo',
            'description'=>'descripcion',
            'due_date'=>'fecha limite'
        ];
    }   
}
