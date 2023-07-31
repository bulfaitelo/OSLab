<?php

namespace App\Http\Requests\Financeiro;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDespesaRequest extends FormRequest
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
            'valor'     => 'required|numeric|min:0|not_in:0',
            'parcelas' => 'numeric',

        ];
    }

        /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'valor' => ($this->valor) ? str_replace(',', '.', str_replace('.','', $this->valor)) : null,
        ]);
    }

    public function messages() : array
     {
        return [
         'name.required' => 'A despesa é obrigatória!'
        ];
    }
}
