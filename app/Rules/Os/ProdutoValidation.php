<?php

namespace App\Rules\Os;

use App\Models\Produto\Produto;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProdutoValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(is_numeric($value)){
            if (! Produto::find($value)) {
                $fail('O produto não é valido');
            }
        }
    }
}
