<?php

namespace App\Http\Requests\Configuracao\Financeiro;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormaPagamentoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:forma_pagamentos',
        ];
    }

    public function messages() : array {
        return [
            'name.required' => 'O campo forma de pagamento é obrigatório',
            'name.unique' => 'Essa forma de pagamento já existe',

        ];
    }
}
