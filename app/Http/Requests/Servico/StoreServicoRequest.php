<?php

namespace App\Http\Requests\Servico;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicoRequest extends FormRequest
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
            'name' => 'required|unique:servicos',
            'valor_servico' => 'required|numeric|min:0|not_in:0'
        ];
    }


    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'valor_servico' => str_replace(',', '.', str_replace('.','', $this->valor_servico))
        ]);
    }

    public function messages(): array {
        return [
            'valor_servico' => 'O valor do serviço é invalido',
            'name.required' => 'O nome de Serviço é obrigatório',
            'name.unique' => 'Esse serviço já foi criado!',
        ];
    }

}
