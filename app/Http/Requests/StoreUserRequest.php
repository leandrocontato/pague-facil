<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $rules = [         
            'first_name'   => 'required',  
            'last_name'    => 'required',  
            'email'        => 'required|unique:user', 
            'password'     => 'required',  
            'status'       => 'required'
        ];      

        return $rules;
    }


   /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        $attibutes = [
            'first_name'   => 'none',
            'last_name'    => 'sobrenome',
            'email'        => 'email',
            'password'     => 'senha',
            'status'       => 'situação'
        ];

        return $attibutes;
    }
}


