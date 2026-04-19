<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CicloFormativoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Lo he dejado en true, ya que no esta desarrollado el módulo de autentificación, es necesario para autorizar la petición
     * Si lo dejo en false, laravel devolvería un 403
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     *
     * Aquí declaro las "reglas" para crear y/o editar ciclos formativo
     *
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:150',
            'familia_profesional' => 'required|string|max:100',
            'grado' => 'required|in:Grado Superior,Grado Medio',
            'modalidad' => 'required|in:Presencial,Semipresencial',
            'decreto_referencia' => 'nullable|string|max:250',
            'activo' => 'boolean',
        ];
    }

    /**
     * Mensajes de error personalizados para los campos del formulario
     */

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del ciclo es obligatorio.',
            'nombre.max' => 'El nombre no puede superar los 150 caracteres.',
            'familia_profesional.required' => 'La familia profesional es obligatoria.',
            'grado.required' => 'Debes seleccionar un grado.',
            'grado.in' => 'El grado debe ser Grado Superior o Grado Medio.',
            'modalidad.required' => 'Debes seleccionar una modalidad.',
            'modalidad.in' => 'La modalidad debe ser Presencial o Semipresencial.',
        ];
    }

}
