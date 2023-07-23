<?php

namespace App\Http\Requests\Financeiro;

use Illuminate\Foundation\Http\FormRequest;

class StoreContasRequest extends FormRequest
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
            'cliente_id' => 'required|exists:clientes,id',
            'vencimento' => 'date|required',
            'valor'     => 'required|numeric|min:0|not_in:0',


            'avista_valor' => 'required_with:avista_pago,on|numeric|min:0|not_in:0|nullable',
            'avista_forma_pagamento_id' => 'required_if:avista_pago,on|exists:forma_pagamentos,id|nullable',

            'parcelas' => 'required_if:parcelado,on|numeric',
            'parcelado_forma_pagamento_id' => 'required_if:parcelado_pago,on|exists:forma_pagamentos,id|nullable',
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

    public function messages() {
        return [
         'name.required' => 'A despesa é obrigatória!'
        ];
    }
}
