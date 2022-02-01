<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePartialCustomerRequest extends FormRequest
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
            'customer_id'   => 'required',
            'email'         => ['required_without_all:password', Rule::unique('customer')->ignore($this->customer_id, 'customer_id')],            
            'password'      => 'required_without_all:email'
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
            'customer_id' => 'Código do Cliente',
            'email'       => 'email',
            'password'    => 'senha',
        ];

        return $attibutes;
    }
}


