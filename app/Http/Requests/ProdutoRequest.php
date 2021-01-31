<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
            'descricao' => 'required|max:100',
            'valor' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'codBarras' => 'required|numeric|digits_between:0,20'
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
            'descricao.required' => 'O campo produto é obrigatório',
            'descricao.max' => 'O campo produto não pode conter mais de 100 caracteres',

            'valor.required' => 'O campo valor é obrigatório',
            // 'valor.digits_between' => 'O campo valor não pode conter mais de 11 caracteres',
            'valor.regex' => 'O campo valor não está no formato correto (ex: 120.23)',


            'codBarras.required' => 'O campo código de barras é obrigatório',
            'codBarras.numeric' => 'O campo código de barras é deve conter apenas números',
            'codBarras.digits_between' => 'O campo código de barras não pode conter mais de 20 caracteres e deve conter apenas números inteiros',
        ];
    }
}
