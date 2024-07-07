<?php

namespace App\Http\Requests\Wiki;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
            'arquivo_import' => 'required|file|max:20000|mimes:zip,bin,rar,pdf',
        ];
    }

    public function messages(): array
    {
        return [
            'arquivo_import.required' => 'o arquivo é obrigatório!',
            'arquivo_import.max' => 'o tamanho máximo de envio é de 20Mb!',
            'arquivo_import.mimes' => 'os arquivos suportados são: .zip, .bin, .rar, .pdf !',
        ];
    }
}
