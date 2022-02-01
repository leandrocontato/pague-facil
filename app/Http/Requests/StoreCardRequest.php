<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCardRequest extends FormRequest
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
            "number_card"           => "required|min:16|unique:card",
            "identidade_customer"   => "required|min:14",
            "flag_card"             => "required",
            "code_card"             => "required:min:3",
            "card_expiry_date"      => "required:min:5",
            "cardholder_name"       => "required",
        ];     

        return $rules;
    }


   /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */

}


