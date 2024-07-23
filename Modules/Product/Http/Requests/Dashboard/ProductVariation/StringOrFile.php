<?php

namespace Modules\Product\Http\Requests\Dashboard\ProductVariation;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

class StringOrFile implements Rule
{
    public function passes($attribute, $value)
    {
        return is_string($value) || $value instanceof UploadedFile;
    }

    public function message()
    {
        return 'The :attribute must be either a string or a file.';
    }
}