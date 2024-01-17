<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'name'         =>'required|max:191|unique:categories,name',
            'hour_price'   =>'numeric|min:0',
            'weight_price' =>'numeric|min:0',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'name'         => trans('messages.Name'),
            'hour_price'   => trans('messages.HourPrice'),
            'weight_price' => trans('messages.WeightPrice'),
        ];
    }
}
