<?php

namespace App\Http\Requests\Configuracao\Wiki;

use Illuminate\Foundation\Http\FormRequest;

class UpdateModeloRequest extends FormRequest
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
            'name' => 'required|unique:wiki_models,name,'.$this->modelo->id,
            'wiki_id' => 'required|exists:wikis,id',

        ];
    }

    public function messages() : array {
        return [
            'name.required' => 'O nome de Modelo é obrigatório',
            'name.unique' => 'Esse Modelo já foi criado!',
            'wiki_id' => 'O Wiki é obrigatório',

        ];
    }
}
