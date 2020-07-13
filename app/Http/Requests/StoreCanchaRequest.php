<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCanchaRequest extends FormRequest
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
            'nombre' => 'required | min:3 | max:15',
            'precio' => 'required | min:5 | max:5 ',
            'complejo_id' => 'required',
            'estado_id' => 'required',
        ];
    }
    public function messages()
    {
        return [         
                                //nombre                
            'nombre.min'        => 'El :attribute debe contener mas de 3 letras.',
            'nombre.max'        => 'El :attribute debe contener max 15 letras.', 
          

                                //precio
            'precio.required'  => 'El :attribute es obligatorio',            
            'precio.min'        => 'Precio muy bajo',
            'precio.max'        => 'precio muy alto',
            'precio.numeric'        => 'solo se admiten números',
            
                                //complejo
            'complejo_id.required' => 'Debe seleccionar el :attribute al que pertenece la Cancha',
                                //estado
            'estado_id.required' => 'Debe seleccionar el :attribute ', 
                                //descripción        
        ];
    }
}
