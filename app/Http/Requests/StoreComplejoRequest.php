<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreComplejoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'  => ['required',Rule::unique('complejos')->ignore($this->route('complejo')->id)],
            'imagen'  => 'image',
            'ubicacion'  => 'required',
            'telefono'  => 'required',
            'latitude'  => 'nullable',
            'longitude'  => 'nullable'
        ];
    }
    public function messages()
    {
        return [         
                                            
            'nombre.required'   => 'El :attribute debe contener max 15 letras.', 
            'nombre.unique'  => 'El Nombre ya existe, por favor ingrese otro.',

            'ubicacion.required'  => 'El Email es obligatorio.',

            'telefono.required'  => 'El Nº de contacto  es obligatorio.',
            'telefono.unique'  => 'El Nº de contacto ya existe, por favor ingrese otro.',


            

        ];
    }
}
