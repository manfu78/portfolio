<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends FormRequest
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
        if (!empty($this->password)) {
            $rules = [
                'name'  => 'required|string|max:255|unique:users,name,'.$this->user->id,
                'email' => 'required|string|email|max:255|unique:users,email,'.$this->user->id,
                // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'password'  =>['same:password_confirmation',
                                Password::min(4)
                                // ->letters() //Al menos una letra
                                // ->mixedCase() //Minúscula y mayúscula
                                // ->numbers() //Al menos un número
                                // ->symbols() //Al menos un simbolo
                                // ->uncompromised() //Comprobar que la contraseña no esté comprometida.
                            ],
            ];

        }else{
            $rules = [
                'name'  =>'required|string|max:255|unique:users,name,'.$this->user->id,
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->user->id],
                'email' =>'nullable|email|unique:users,email,'.$this->user->id,
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'name'  =>trans('messages.UserName'),
        ];
    }
}
