<?php

namespace Modules\Order\Http\Requests\Dashboard\PytmentMethod;

use Modules\Base\Http\Requests\BaseRequest;

class UpdatePytmentMethodRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'method' => 'required|string',
        ];
    }
}
