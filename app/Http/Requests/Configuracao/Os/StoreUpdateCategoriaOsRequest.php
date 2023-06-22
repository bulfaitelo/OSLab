<?php

namespace App\Http\Requests\Configuracao\Os;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCategoriaOsRequest extends FormRequest
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
            'garantia_id' => 'nullable|exists:garantias,id'
        ];
    }
}
