<?php

namespace App\Http\Requests\Configuracao\Os;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateGarantiaRequest extends FormRequest
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
            'prazo_garantia' => 'integer|nullable',
            'garantia' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do termo de garantia é obrigatório',
            'prazo_garantia.integer' => 'O prazo de garantia deve ser em dias e apenas números',
            'garantia.required' => 'O campo de Termo de Garantia deve ser preenchido',
        ];
    }
}
