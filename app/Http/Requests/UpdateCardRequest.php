<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCardRequest extends FormRequest
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
        //, Rule::unique('customer')->ignore($this->customer_id, 'customer_id')
        $rules = [
            'flag_card'         => 'required', 
            'number_card'       => 'required|unique:card',            
            'code_card'         => 'required',
            'card_expiry_date'  => 'required',
            'cardholder_name'   =>'required',
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
            'card_id'           => 'código do cartao',
            'flag_card'         => 'bandeira do cartao',
            'number_card'       => 'numero',
            'code_card'         => 'codigo',
            'card_expiry_date'  => 'data de expiracao do cartao',
            'cardholder_name'   => 'Nome do titular',
            'customer_id'       => 'usuário',
        ];


        return $attibutes;
    }
}


