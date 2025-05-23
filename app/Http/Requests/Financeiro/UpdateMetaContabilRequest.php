<?php

namespace App\Http\Requests\Financeiro;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMetaContabilRequest extends FormRequest
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
            'name' => 'required',
            'valor_meta' => 'required|numeric|min:0|not_in:0',
            'centro_custo_id' => 'exists:centro_custos,id|nullable',
            'intervalo' => 'required|in:mes,ano',
            'tipo_meta' => 'required|in:R,D',

        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'valor_meta' => ($this->valor_meta) ? str_replace(',', '.', str_replace('.', '', $this->valor_meta)) : null,
        ]);
    }
}
