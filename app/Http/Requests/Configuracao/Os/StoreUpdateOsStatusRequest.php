<?php

namespace App\Http\Requests\Configuracao\Os;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateOsStatusRequest extends FormRequest
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
            'ativar_rastreio' => 'nullable|in:1,null',
            'ativar_email' => 'nullable|in:1,null',
            'color' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do Status é obrigatório',
            'color.required' => 'Selecione uma das opções de cores a baixo',
        ];
    }
}
