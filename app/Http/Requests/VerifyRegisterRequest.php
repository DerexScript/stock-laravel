<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyRegisterRequest extends FormRequest
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
            'name' => 'required|min:4',
            'surname' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'username' => 'required|regex:/^[a-zA-Z].{1,15}/i|unique:users',
            'password' => 'required|min:8|required_with:confirmPassword|same:confirmPassword',
            'confirmPassword' => 'required|min:8',
            'terms' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Você precisa informar um nome.',
            'name.min' => 'Você precisa informar no minimo 4 caracteres.',

            'surname.required' => 'Você precisa informar um sobrenome.',
            'surname.min' => 'Você precisa informar um sobrenome com no minimo 4 caracteres',

            'email.required' => 'Você precisa informar um e-mail.',
            'email.email' => 'Você precisa informar um e-mail valido.',

            'username.required' => 'Você precisa informar um nome de usuario.',
            'username.regex' => 'Usuario informado não atende aos requisitos.',

            'password.required' => 'Você precisa informar uma senha',
            'password.min' => 'Sua senha precisa ter no minimo 8 caracteres.',
            'password.required_with' => 'Você tambem precisa informar o campo de confirmação de senha',
            'password.same' => 'O campo senha e confirmar senha devem ser iguais.',

            'confirmPassword.required' => 'O campo de confirmação da senha é obrigatório.',
            'confirmPassword.min' => 'A senha de confirmação deve ter pelo menos 8 caracteres.',

            'terms.required' => 'Você precisa aceitar os termos.',
        ];
    }

}
