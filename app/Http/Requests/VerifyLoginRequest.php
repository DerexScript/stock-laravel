<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyLoginRequest extends FormRequest
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
            'credential' => 'required',
            'password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'credential.required' => 'Você precisa informar um e-mail ou usuario valido.',
            'password.required' => 'Você precisa informar uma senha.',
            'password.min' => 'Sua senha precisa ter no minimo 8 caracteres.'
        ];
    }

}
