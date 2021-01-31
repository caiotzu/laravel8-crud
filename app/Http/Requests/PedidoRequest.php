<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PedidoRequest extends FormRequest
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
            'cliente_id' => 'required|numeric',
            'produto_id' => 'required|numeric',
            'status' => [
                'required',
                Rule::in(['Em Aberto', 'Pago', 'Cancelado'])    
            ],
            'quantidade_produto' => 'required|numeric',
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
            'cliente_id.required' => 'O campo cliente é obrigatório',
            'cliente_id.numeric' => 'Valor do campo cliente é inválido',

            'produto_id.required' => 'O campo produto é obrigatório',
            'produto_id.numeric' => 'Valor do produto é inválido',

            'status.required' => 'O campo status é obrigatório',
            'status.in' => 'Valor do status é inválido',

            'quantidade_produto.required' => 'O campo quandidade do produto é obrigatório',
            'quantidade_produto.numeric' => 'Valor da quantidade de produto é inválido',
        ];
    }
}
