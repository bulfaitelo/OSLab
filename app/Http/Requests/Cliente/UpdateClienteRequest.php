<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
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
            'email' => 'nullable|email|unique:clientes,email,'.$this->cliente->id,
            'password' => 'nullable|confirmed|min:8',
            'uf' => 'nullable|max:2',
            'registro' => 'cpf_ou_cnpj|nullable|unique:clientes,registro,'.$this->cliente->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Cliente é obrigatório.',
            'registro.unique' => 'O CPF ou CNPJ já está em uso.',
        ];
    }
}

