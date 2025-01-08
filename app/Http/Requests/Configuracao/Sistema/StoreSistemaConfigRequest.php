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
            'sistema.default_os_create_status' => 'required|exists:status,id',
            'sistema.os_link_time_limit' => 'required|integer',
            'sistema.default_os_faturar_produto_despesa' => 'required|exists:forma_pagamentos,id',
            'sistema.default_os_faturar' => 'nullable|exists:status,id',
            'sistema.default_os_faturar_pagto_parcial' => 'nullable|exists:status,id',
            'sistema.default_os_faturar_pagto_quitado' => 'nullable|exists:status,id',
            'sistema.os_informacao' => 'nullable|string|max:1000',
            'sistema.os_listagem_padrao' => 'nullable|exists:status,id',

            'sistema.backup_local_store' => 'boolean',
            'sistema.backup_gdrive_store' => 'boolean',
            // 'sistema.backup_recorrencia' => 'required|in:d,w,m,y',
            'sistema.backup_horario' => 'required|date_format:H:i',

            'sistema.default_venda_create_status' => 'required|exists:status,id',
            'sistema.default_venda_faturar' => 'nullable|exists:status,id',
            'sistema.default_venda_faturar_pagto_parcial' => 'nullable|exists:status,id',
            'sistema.default_venda_faturar_pagto_quitado' => 'nullable|exists:status,id',
            'sistema.default_venda_faturar_produto_despesa' => 'nullable|exists:status,id',
            'sistema.venda_listagem_padrao' => 'nullable|exists:status,id',
            'sistema.default_venda_create_garantia' => 'required|exists:garantias,id',
        ];
    }

    public function messages(): array
    {
        return [
            'sistema.default_os_create_status' => 'Por favor selecione uma Status Padrão OS',
            'sistema.os_link_time_limit' => 'Por favor defina o Tempo da validade do Link',
            'sistema.default_os_faturar_produto_despesa' => 'Por favor defina o Tipo de despesa Padrão',
            'sistema.backup_horario' => 'Por favor defina uma hora valida para realização do backup',
            'sistema.backup_recorrencia' => 'Por favor selecione um período válido para realização do backup.',

            'sistema.default_venda_create_status' => 'Por favor selecione uma Status Padrão para Venda',
            'sistema.default_venda_faturar_produto_despesa' => 'Por favor defina o Tipo de despesa Padrão para a Venda',
        ];
    }

    protected function passedValidation()
    {
        $data = $this->validated()['sistema'];
        foreach ($data as $key => $value) {
            $data[$key] = json_encode($data[$key]);
        }
        // $data['os_listagem_padrao'] = json_encode($data['os_listagem_padrao']);
        // dd($data);
        $this->merge([
            'sistema' => $data,
        ]);
    }
}
