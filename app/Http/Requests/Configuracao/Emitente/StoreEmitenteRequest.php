<?php

namespace App\Http\Requests\Configuracao\Emitente;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmitenteRequest extends FormRequest
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
            'name' => 'required|',
            'email' => 'nullable|email',
            'uf'=> 'nullable|max:2',
            'registro' => 'cnpj|nullable',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'O campo Cliente é obrigatório.',
            'registro.cnpj' => 'O CNPJ não é válido.',
        ];
    }
}
