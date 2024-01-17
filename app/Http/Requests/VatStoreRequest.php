<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VatStoreRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'vat'        => 'required|numeric|min:0|max:100|not_in:0',
            'surcharge'  => 'required|numeric|min:0|max:100|not_in:0',
            'description'=> 'required|max:190',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'vat'           => trans('messages.Vat.Vat'),
            'surcharge'     => trans('messages.Vat.Surcharge'),
            'description'   => trans('messages.Vat.Description'),
        ];
    }
}
