<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'                  =>'required|max:255',
            'cif'                   =>'required|max:9|unique:customers,cif,'.$this->customer->id,
            'email'                 =>'nullable|email|max:255',
            'ncc'                   =>'nullable|numeric',
            'bic'                   =>'nullable|alpha_num|max:255',
            'iban'                  =>'nullable|alpha_num|max:24|min:24',
            'comercial_discount'    =>'nullable|numeric',
            'pront_payment_discount'=>'nullable|numeric',
            'risk'                  =>'nullable|numeric',
        ];

        return $rules;
    }
}
