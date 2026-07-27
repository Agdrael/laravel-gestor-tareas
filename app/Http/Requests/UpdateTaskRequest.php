<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
            'completed' => ['required', 'boolean'],
            'category_id' => ['required', 'integer', 'exists:categories,id']
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El titulo es obligatorio',
            'title.string' => 'El titulo debe de ser texto',
            'title.max' => 'El titulo no puede tener más de 255 caracteres',
            'description.string' => 'La descripcion debe ser texto',
            'due_date.date' => 'La fecha limite debe tener una fecha valida',
            'completed.required' => 'El estado de la tarea es obligatorio',
            'completed.boolean' => 'El estado de la tarea no es valido'
        ];
    }
}
