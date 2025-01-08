<?php

namespace App\Http\Requests\Venda;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendaRequest extends FormRequest
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
            'cliente_id' => 'required|exists:clientes,id',
            'vendedor_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:status,id',
            'termo_garantia_id' => 'required|exists:garantias,id',
            'data_saida' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'cliente_id' => 'Por favor preencha um cliente valido',
            'vendedor_id' => 'Por favor preencha um técnico valido',
            'status_id' => 'Por favor preencha um status valido',
            'termo_garantia_id' => 'Por favor preencha uma garantia valida',
            'categoria_id' => 'Por favor preencha uma categoria valida',
            'data_saida' => 'Por favor preencha uma data de saída valida',
        ];
    }
}
