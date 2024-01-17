<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessUpdateRequest extends FormRequest
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
            'name'          =>'required|string|max:191',
            'cif'           =>'required|unique:businesses,cif,'.$this->business->id,
            'email'         =>'required|email|unique:businesses,email,'.$this->business->id,
            'logo'          =>'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => trans('messages.Name'),
            'cif'  => 'CIF',
        ];
    }
}
