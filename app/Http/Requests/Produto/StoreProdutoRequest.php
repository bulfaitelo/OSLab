<?php

namespace App\Http\Requests\Produto;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
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
            'name' => 'required|unique:produtos',
            'valor_custo' => 'nullable|numeric|min:0|not_in:0',
            'valor_venda' => 'required|numeric|min:0|not_in:0',
            'estoque'   => 'required|numeric',
            'estoque_minimo'   => 'nullable|numeric',
            'centro_custo_id' => 'required|exists:centro_custos,id',
        ];
    }


    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'valor_custo' => ($this->valor_custo) ? str_replace(',', '.', str_replace('.','', $this->valor_custo)) : null,
            'valor_venda' => str_replace(',', '.', str_replace('.','', $this->valor_venda)),
        ]);
    }


    public function messages() : array {
        return [
           'name.required' => 'O nome do Produto é obrigatório',
           'name.unique' => 'O nome do Produto já está em uso',
           'valor_venda.required' => 'O valor de venda do Produto é obrigatório ',

        ];
    }


}
