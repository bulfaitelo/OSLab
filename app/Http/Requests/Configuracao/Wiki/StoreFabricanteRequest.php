<?php

namespace App\Http\Requests\Configuracao\Wiki;

use Illuminate\Foundation\Http\FormRequest;

class StoreFabricanteRequest extends FormRequest
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
            'name' => 'required|unique:fabricantes',

        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'O nome de Fabricante é obrigatório',
            'name.unique' => 'Esse Fabricante já foi criado!',
        ];
    }
}
