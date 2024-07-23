<?php

namespace Modules\Order\Http\Requests\Dashboard\PytmentMethod;

use Modules\Base\Http\Requests\BaseRequest;

class GetAllPytmentMethodRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'per_page' => 'integer|min:1|nullable',
        ];
    }
}
