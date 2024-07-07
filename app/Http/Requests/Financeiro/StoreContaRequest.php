<?php

namespace App\Http\Requests\Financeiro;

use Illuminate\Foundation\Http\FormRequest;

class StoreContaRequest extends FormRequest
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
            'name' => 'required',
            'centro_custo_id' => 'required|exists:centro_custos,id',
            'cliente_id' => 'required_without:os_id|exists:clientes,id',
            'vencimento' => 'date|required',
            'valor'     => 'required|numeric|min:0|not_in:0',
            'forma_pagamento_id' => 'required|exists:forma_pagamentos,id',

            'avista_valor' => 'required_with:avista_pago,on|numeric|min:0|not_in:0|nullable',

            'parcelas' => 'required_if:parcelado,on|numeric',

            'os_id' => 'nullable|exists:os,id'
        ];
    }


    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'valor' => ($this->valor) ? str_replace(',', '.', str_replace('.','', $this->valor)) : null,
            'avista_valor' => ($this->avista_valor) ? str_replace(',', '.', str_replace('.','', $this->avista_valor)) : null,

        ]);
    }

    public function messages(): array
     {
        return [
         'name.required' => 'A despesa é obrigatória!',
         'pagamento_id' => 'A forma de pagamento é obrigatória ',
         'cliente_id' => 'O Cliente / Fornecedor é obrigatório',
        ];
    }
}
