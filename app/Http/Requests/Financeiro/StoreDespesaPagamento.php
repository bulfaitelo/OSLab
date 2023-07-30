<?php

namespace App\Http\Requests\Financeiro;

use Illuminate\Foundation\Http\FormRequest;

class StoreDespesaPagamento extends FormRequest
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
            'vencimento' => 'date|required',
            'parcela' => 'required|integer',

            'pagamento_valor'     => 'numeric|min:0|not_in:0',
            'data_pagamento' => 'date',
            'forma_pagamento_id' => 'exists:forma_pagamentos,id',

        ];
    }


        /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'pagamento_valor' => ($this->pagamento_valor) ? str_replace(',', '.', str_replace('.','', $this->pagamento_valor)) : null,

        ]);
    }
}
