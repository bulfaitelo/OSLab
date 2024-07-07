<?php

namespace App\Http\Requests\Produto;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateMovimentacaoRequest extends FormRequest
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
            'estoque' => 'required|numeric',
            'valor_custo' => 'nullable|numeric|min:0|not_in:0',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'valor_custo' => ($this->valor_custo) ? str_replace(',', '.', str_replace('.', '', $this->valor_custo)) : null,
        ]);
    }

    public function messages(): array
    {
        return [
            'estoque.required' => 'A quantidade de entrada obrigatória',
        ];
    }
}
