<?php

namespace App\Http\Requests\Checklist;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateChecklistRequest extends FormRequest
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
            'checklist_name' => 'required',
            'categoria_id' => 'required|exists:os_categorias,id',
        ];
    }

    public function messages() : array {
        return [
            'name.required' => 'O nome do Checklist é obrigatório',
            'categoria_id' => 'O campo categoria é obrigatório',
        ];
    }
}
