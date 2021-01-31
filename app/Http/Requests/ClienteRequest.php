<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'nome'  => 'required|max:100',
            'cpf'   => 'required|min:14|max:14',
            'email' => 'required|max:10|email'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.max' => 'O campo nome não pode conter mais de 100 caracteres',

            'cpf.required' => 'O campo CPF é obrigatório',
            'cpf.min' => 'O campo CPF não pode conter mais/menos de 11 digitos',
            'cpf.max' => 'O campo CPF não pode conter mais/menos de 11 digitos',


            'email.required' => 'O campo e-mail é obrigatório',
            'email.max' => 'O campo e-mail não pode conter mais de 10 caracteres',
            'email.email' => 'O campo e-mail não está no formato correto',
        ];
    }
}
