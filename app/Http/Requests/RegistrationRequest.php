<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string'
            ],
            'surname' => [
                'required',
                'string'
            ],
            'city' => [
                'required',
                'string'
            ]
            ,
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'required'
            ],
            'password_confirmation' => [
                'required',
                'same:password'
            ],
            'phone_number' => [
                'required',
                'string'
            ]
        ];
    }
}
