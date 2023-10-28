<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateUserRequest extends FormRequest
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
            'correo' => 'required|email|unique:usuarios',
            'activo' => 'required|boolean',
            'roles_id' => 'nullable|array'
        ];
    }

    public function messages()
    {
        return [
            'correo' => 'El correo es requerido',
            'correo.email' => 'El correo no es valido',
            'correo.unique' => 'El correo ya esta registrado',
            'contrasena.required' => 'La contraseña es requerido',
            'contrasena.min' => 'La contraseña debe tener minimo 8 caracteres',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, response()->json([
            'type' => 'error',
            'messages' => [$validator->errors()],
            'data' => null
        ], 400));
    }

}
