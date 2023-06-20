<?php

namespace App\Http\Requests\Configuracao\Financeiro;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCentroCustoRequest extends FormRequest
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
            'name'=> 'required',
            'receita' => 'required_without:despesa|in:1,null',
            'despesa' => 'required_without:receita|in:1,null'
        ];
    }

    public function messages() : array {
        return [
            'name' => 'O campo Centro de Custo é obrigatório'
        ];
    }
}
