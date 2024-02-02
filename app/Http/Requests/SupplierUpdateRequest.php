<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'name'  =>'required',
            'cif'   =>'required|unique:suppliers,cif,'.$this->supplier->id,
            'email' =>'nullable|email|unique:suppliers,email,'.$this->supplier->id,
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'name'              => trans('messages.Name'),
            'cif'               => 'CIF',
            'tradename'         =>trans('messages.Tradename'),
            'phone'             =>trans('messages.Phone'),
            'address'           =>trans('messages.Address'),
            'postal_code'       =>trans('messages.PostalCode'),
            'city'              =>trans('messages.City'),
            'province'          =>trans('messages.Province'),
            'latitude'          =>trans('messages.Latitude'),
            'longitude'         =>trans('messages.Longitude'),

            'country_id'        =>trans('messages.Country'),
            'vat_id'            =>trans('messages.Vat.Vat'),
            'payment_method_id' =>trans('messages.PaymentMethod.PaymentMethod'),
            'status'            =>trans('messages.Status'),
            'user_id_mod'       =>trans('messages.User'),
        ];
    }
}
