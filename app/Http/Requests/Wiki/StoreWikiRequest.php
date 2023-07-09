<?php

namespace App\Http\Requests\Wiki;

use Illuminate\Foundation\Http\FormRequest;

class StoreWikiRequest extends FormRequest
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
            'fabricante_id' => 'required|exists:fabricantes,id',
            'name' => 'required|unique:wikis',
            'modelo' => 'required|unique:wiki_models,name',
            'categoria_id' => 'required|exists:categoria_os,id',

        ];
    }

    public function messages() : array {
        return [
           'fabricante_id' => 'O Fabricante é obrigatório',
           'name' => 'O nome do dispositivo é obrigatório',
           'name.unique' => 'O nome do dispositivo já está em uso!',
           'modelo' => 'O modelo é obrigatório',
           'modelo.unique' => 'O modelo já está em uso!',


        ];
    }
}
