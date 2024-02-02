<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoinTypeUpdateRequest extends FormRequest
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
            'name'          => 'required|unique:coin_types,name,'.$this->coinType->id,
            'code'          => 'required|max:3|min:3|alpha||unique:coin_types,code,'.$this->coinType->id,
            'sign'          => 'required|max:10|unique:coin_types,sign,'.$this->coinType->id,
            'sign_html'     => 'required|max:10|unique:coin_types,sign_html,'.$this->coinType->id,
            'equivalence'   => 'required|numeric|min:0|max:100|not_in:0',
            'default'       => "boolean",
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            'name'          => trans('messages.Name'),
            'sign'          => trans('messages.Sign'),
            'sign_html'     => trans('messages.Sign'),
            'equivalence'   => trans('messages.Equivalence'),
            'user_id_mod'   => trans('messages.User'),
            'default'       => trans('messages.DefaultCoin'),
        ];
    }
}
