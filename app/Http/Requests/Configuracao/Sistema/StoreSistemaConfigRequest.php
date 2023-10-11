<?php

namespace App\Http\Requests\Configuracao\Sistema;

use Illuminate\Foundation\Http\FormRequest;

class StoreSistemaConfigRequest extends FormRequest
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
            'sistema.default_os_create_status' => 'required|exists:status_os,id',
            'sistema.os_link_time_limit' => 'required|integer'

        ];
    }
}
