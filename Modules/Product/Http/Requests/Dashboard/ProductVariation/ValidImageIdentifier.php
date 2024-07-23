<?php

namespace Modules\Product\Http\Requests\Dashboard\ProductVariation;

use Illuminate\Contracts\Validation\Rule;

class ValidImageIdentifier implements Rule
{
    public function passes($attribute, $value)
    {
        // Implement your logic here
        // For example, check if it's a valid file path or matches a specific pattern
        return preg_match('/^[a-zA-Z0-9_\-\/]+\.(jpg|jpeg|png|gif)$/i', $value);
    }

    public function message()
    {
        return 'The :attribute must be a valid image identifier.';
    }
}