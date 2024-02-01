<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerUpdateRequest extends FormRequest
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
            'name'          =>'required',
            'nif'           =>'required|unique:workers,nif,'.$this->worker->id,
            'email'         =>'nullable|email|unique:workers,email,'.$this->worker->id,
            'photo'         =>'image|mimes:jpeg,png,jpg,gif,svg|max:10240',

            'status'        =>'boolean',

            'lastname'      => 'nullable|max:191',
            'phone'         => 'nullable|max:191',
            'address'       => 'nullable|max:191',
            'postal_code'   => 'nullable|max:191',
            'city'          => 'nullable|max:191',
            'province'      => 'nullable|max:191',
            'latitude'      => 'nullable|max:191',
            'longitude'     => 'nullable|max:191',
            'observations'  => 'nullable',

            'category_id'   => 'nullable|exists:categories,id',
            'country_id'    => 'exists:countries,id',
            'category_id'   => 'exists:categories,id',
            'business_id'   => 'exists:businesses,id',

            'user_id'       =>'nullable|exists:users,id|unique:workers,user_id'.$this->worker->id,
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            'photo'                 => trans('messages.Photo'),
            'name'                  => trans('messages.Name'),
            'nif'                   => 'NIF',
            'lastname'              => trans('messages.Lastname'),
            'phone'                 => trans('messages.Phone'),
            'address'               => trans('messages.Address'),
            'postal_code'           => trans('messages.PostalCode'),
            'city'                  => trans('messages.City'),
            'province'              => trans('messages.Province'),
            'latitude'              => trans('messages.Latitude'),
            'longitude'             => trans('messages.Longitude'),
            'status'                => trans('messages.Status'),
            'observations'          => trans('messages.Observations'),

            'country_id'            => trans('messages.Country.Country'),
            'category_id'           => trans('messages.Category.Category'),
            'business_id'           => trans('messages.Business.Business'),
            'user_id'               => trans('messages.User.User'),
        ];
    }
}
