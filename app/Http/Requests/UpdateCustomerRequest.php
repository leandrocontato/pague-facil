<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
            'customer_id'  => 'required',
            'email'        => ['required', Rule::unique('customer')->ignore($this->customer_id, 'customer_id')], 
            'type'         => 'required',            
            'address'      => 'required',
            'number'       => 'required',
            'cep'          => 'required',
            'neighoarhood' => 'required',
            'countrie_id'  => 'required',
            'state_id'     => 'required',
            'citie_id'     => 'required'
        ];

        if($this->type == 1)
        {
            $rules['first_name'] = 'required'; 
            $rules['last_name']  = 'required';              
            $rules['cpf']        = ['required', Rule::unique('customer')->ignore($this->customer_id, 'customer_id')];

        } else {
            $rules['company_name'] = 'required'; 
            $rules['fantasy_name'] = 'required'; 
            $rules['cnpj']         = ['required', Rule::unique('customer')->ignore($this->customer_id, 'customer_id')];
        }        

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
            'customer_id'  => 'código do cliente',
            'address'      => 'endereço',
            'number'       => 'numero',
            'cep'          => 'cep',
            'neighoarhood' => 'bairro',
            'countrie_id'  => 'pais',
            'state_id'     => 'estado',
            'citie_id'     => 'cidade'
        ];

        if($this->type == 1)
        {
           $attibutes['first_name'] = 'nome'; 
           $attibutes['last_name']  = 'sobrenome';              
           $attibutes['cpf']        = 'cpf'; 

        } else {
            $attibutes['company_name'] = 'razão social'; 
            $attibutes['fantasy_name'] = 'nome fantasia'; 
            $attibutes['cnpj']         = 'cnpj'; 
        } 

        return $attibutes;
    }
}


