<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerContactStoreRequest extends FormRequest
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
            'contact'   => 'required|max:255',
            'phone'     => 'nullable|string|max:255',
            'email'     => 'nullable|email|max:255',
            'position'  => 'nullable|string|max:255',
        ];

        return $rules;
    }
}
