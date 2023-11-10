<?php

namespace App\Http\Requests\Configuracao\Sistema;

use Illuminate\Foundation\Http\FormRequest;

class StoreSistemaConfigRequest extends FormRequest
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
            'sistema.default_os_create_status' => 'required|exists:os_status,id',
            'sistema.os_link_time_limit' => 'required|integer',
            'sistema.default_os_faturar_produto_despesa' => 'required|exists:forma_pagamentos,id',


        ];
    }

    public function messages(): array
    {
        return [
            'sistema.default_os_create_status' => 'Por favor selecione uma Status Padrão OS',
            'sistema.os_link_time_limit' => 'por favor defina o Tempo da validade do Link',
            'sistema.default_os_faturar_produto_despesa' => 'por favor defina o Tipo de despesa Padrão',
        ];
    }
}
