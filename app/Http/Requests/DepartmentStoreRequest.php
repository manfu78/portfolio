<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentStoreRequest extends FormRequest
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
            'name'          =>'required|string|max:255|unique:departments,name',
            'description'   =>'nullable|string',
            'areas'         =>'nullable|exists:areas,id',
        ];

        return $rules;
    }

    public function attributes():array
    {
        return [
            'name'         => trans('messages.Name'),
            'description'  => trans('messages.Description'),
        ];
    }
}
