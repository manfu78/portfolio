<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191','unique:users,name'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password'  =>['required','same:password_confirmation',
                            Password::min(4)
                            // ->letters() //Al menos una letra
                            // ->mixedCase() //Minúscula y mayúscula
                            // ->numbers() //Al menos un número
                            // ->symbols() //Al menos un simbolo
                            // ->uncompromised() //Comprobar que la contraseña no esté comprometida.
                        ],

        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            'name'  =>trans('messages.UserName'),
        ];
    }
}
