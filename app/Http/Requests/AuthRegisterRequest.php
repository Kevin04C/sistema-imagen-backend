<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AuthRegisterRequest extends FormRequest
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
            'apellidos' => 'required|string',
            'dni' => 'required|int|unique:usuarios',
            'correo' => 'required|email|unique:usuarios',
            'contrasena' => 'required|string|min:8',
            'id_rol' => 'nullable|int'
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'correo' => 'El correo es requerido',
            'correo.email' => 'El correo no es valido',
            'correo.unique' => 'El correo ya esta registrado',
            'contrasena.required' => 'La contraseña es requerido',
            'contrasena.min' => 'La contraseña debe tener minimo 8 caracteres',
            'dni.required' => 'El dni es requerido',
            'dni.unique' => 'El dni ya esta registrado',
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
