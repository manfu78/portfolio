<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'code'    => "required|integer|between:1,32767|unique:countries,code,".$this->country->id,
            'iso1'    => 'required',
            'iso2'    => 'required',
            'name'    => "required|unique:countries,name,".$this->country->id,
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            'code'=>trans('messages.Code'),
            'name'=>trans('messages.Name'),
            'iso1'=>'ISO1',
            'iso2'=>'ISO2',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'code.required'=>'Debe ingrear un código',
    //     ];
    // }
}
