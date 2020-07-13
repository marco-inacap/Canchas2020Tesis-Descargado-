<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
        $rules =  [
            'name'  => 'required',
            'email'  => ['required',Rule::unique('users')->ignore($this->route('user')->id)],
            'complejos'  => 'required',
        ];

        if($this->filled('password'))
        {
            $rules['password'] = ['confirmed','min:6'];
        }
        return $rules;
    }
    public function messages()
    {
        return [         
                                //nombre                
            'name.min'        => 'El :attribute debe contener mas de 3 letras.',
            'name.max'        => 'El :attribute debe contener max 15 letras.', 
            'name.required'   => 'El :attribute debe contener max 15 letras.', 


            'email.required'  => 'El Email es obligatorio.',
            'email.unique'  => 'El Email ya existe, por favor ingrese otro.',
            'complejos.required'  => 'El Complejo es obligatorio.',

        ];
    }
}
