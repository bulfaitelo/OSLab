<?php

namespace App\Http\Requests\Os;

use Illuminate\Foundation\Http\FormRequest;

class StoreOsRequest extends FormRequest
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
            'cliente_id' => 'required|exists:clientes,id',
            'tecnico_id' => 'required|exists:users,id',
            'categoria_id' => 'required|exists:categoria_os,id',
            'modelo_id' => 'nullable|exists:wiki_models,id',
            'status_id' => 'required|exists:os_status,id',
            'data_entrada' => 'required|date',
            'data_saida' => 'nullable|date',
        ];
    }

    public function messages() : array
    {
       return [
            'cliente_id' => 'Por favor preencha um cliente valido',
            'tecnico_id' => 'Por favor preencha um técnico valido',
            'categoria_id' => 'Por favor preencha uma categoria valida',
            'modelo_id' => 'Por favor preencha um modelo valido',
            'status_id' => 'Por favor preencha um status valido',
            'data_entrada' => 'Por favor preencha uma data de entrada valida',
            'data_saida' => 'Por favor preencha uma data de saída valida',


       ];
    }
}
