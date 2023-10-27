<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string',
            'imagen' => 'required|image',
            'stock' => 'required|integer',
            'categoria_id' => 'required|integer',
            'precio' => 'required|numeric',
            'activo' => 'required|int|boolean',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.string' => 'El nombre debe ser un texto',
            'stock.required' => 'El stock es requerido',
            'stock.integer' => 'El stock debe ser un número entero',
            'categoria_id.required' => 'La categoría es requerida',
            'categoria_id.integer' => 'La categoría debe ser un número entero',
            'categoria_id.exists' => 'La categoría no existe',
            'precio.required' => 'El precio es requerido',
            'precio.numeric' => 'El precio debe ser un número',
            'activo.required' => 'El estado es requerido',
            'activo.boolean' => 'El estado debe ser un booleano',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'type' => 'error',
            'messages' => [$validator->errors()],
            'data' => []
        ], 400));
    }

}
