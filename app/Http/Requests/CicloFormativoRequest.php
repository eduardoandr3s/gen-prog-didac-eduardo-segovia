<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

     // nombre único en la tabla ciclos_formativos, pero al editar ignoro el propio registro
  // para que no falle la validación por coincidir consigo mismo
        return [
            'nombre' => [
            'required','string','max:150',
            Rule::unique('ciclos_formativos', 'nombre')
            ->ignore($this->ciclo),
            ],
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
            'nombre.unique'=> 'Ya existe un ciclo formativo con el nombre ingresado.',
            'nombre.required' => 'El nombre del ciclo es obligatorio.',
            'nombre.max' => 'El nombre no puede superar los 150 caracteres.',
            'familia_profesional.required' => 'La familia profesional es obligatoria.',
            'grado.required' => 'Debes seleccionar un grado.',
            'grado.in' => 'El grado debe ser Grado Superior o Grado Medio.',
            'modalidad.required' => 'Debes seleccionar una modalidad.',
            'modalidad.in' => 'La modalidad debe ser Presencial o Semipresencial.',
            'familia_profesional.max' => 'La familia profesional no puede superar los 100 caracteres.',
            'decreto_referencia.max' => 'El decreto de referencia no puede superar los 250 caracteres.',
        ];
    }

}
