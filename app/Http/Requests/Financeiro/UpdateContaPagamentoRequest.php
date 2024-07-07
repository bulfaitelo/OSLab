<?php

namespace App\Http\Requests\Financeiro;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContaPagamentoRequest extends FormRequest
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
            'forma_pagamento_id' => 'required|exists:forma_pagamentos,id',

            'data_pagamento' => 'date|nullable',
            'pagamento_valor'     => 'required_unless:data_pagamento,null|numeric|min:0|not_in:0|nullable',

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

    public function messages(): array
    {
       return [
        'name.required' => 'A despesa é obrigatória!',
        'pagamento_valor' => 'O valor do pagamento é obrigatório ',
        'data_pagamento' => 'A data de pagamento é obrigatória',
        'forma_pagamento_id' => 'A forma de pagamento é obrigatória',
       ];
   }
}
