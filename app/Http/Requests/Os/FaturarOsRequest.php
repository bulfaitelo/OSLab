<?php

namespace App\Http\Requests\Os;

use Illuminate\Foundation\Http\FormRequest;

class FaturarOsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'descricao' => 'required',
            'centro_custo_id' => 'required|exists:centro_custos,id',
            'data_entrada' => 'required|date',
            'valor' => 'required|numeric|min:0',
            'valor_recebido' => 'required_if:recebido,on',
            'data_recebimento' => 'date|required_if:recebido,on',
            'forma_pagamento_id' => 'exists:forma_pagamentos,id|required_if:recebido,on|nullable',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'valor' => ($this->valor) ? str_replace(',', '.', str_replace('.', '', $this->valor)) : null,
            'valor_recebido' => ($this->valor_recebido) ? str_replace(',', '.', str_replace('.', '', $this->valor_recebido)) : null,
        ]);
    }

    public function messages(): array
    {
        return [
            'valor_recebido' => 'Por favor preencha o valor recebido, caso houver pagamento',
            'forma_pagamento_id' => 'Por favor forma de pagamento, caso houver pagamento',
            'data_recebimento' => 'Por favor data de recebimento, caso houver pagamento',
            'centro_custo_id' => 'Por favor selecione um centro de custo',
        ];
    }
}
