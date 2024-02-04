<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaUpdateRequest extends FormRequest
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
            'name'         =>'required|string|unique:areas,name,'.$this->area->id,
            'description'  =>'nullable|string',
            'departments'  =>'nullable|exists:departments,id',
            'business_id'  =>'required|exists:businesses,id',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'name'         => trans('messages.Name'),
            'description'  => trans('messages.Description'),
            'business_id'  => trans('messages.Business.Business'),
        ];
    }
}
