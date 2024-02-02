<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankAccountStoreRequest extends FormRequest
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
            'name'  => 'required|unique:bank_accounts,name',
            'email' => 'email:rfc,dns',
            'ncc'   => 'numeric',
            'bic'   => 'alpha_num',
            'iban'  => 'alpha_num|max:24|min:24',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => trans('messages.Name'),
        ];
    }
}
