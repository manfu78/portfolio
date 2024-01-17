<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodUpdateRequest extends FormRequest
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
            'name'              =>'required|string|max:191|unique:payment_methods,name,'.$this->paymentMethod->id,
            'postponement_days' =>'required|numeric|min:0',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'name'               => trans('messages.PaymentMethod.PaymentMethod'),
            'postponement_days'  => trans('messages.PostponementDays'),
        ];
    }
}
