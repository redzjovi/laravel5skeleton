<?php

namespace App\Http\Requests\API\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class VerifyRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'between:0,191', 'email', 'exists:users,email'],
            'verification_code' => [
                'required', 'between:0,6',
                new \App\Rules\Users\EmailVerificationCodeCheck($this->input()),
            ],
        ];
    }
}
