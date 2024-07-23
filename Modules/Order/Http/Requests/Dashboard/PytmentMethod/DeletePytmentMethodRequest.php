<?php

namespace Modules\Order\Http\Requests\Dashboard\PytmentMethod;

use Modules\Base\Http\Requests\BaseRequest;

class DeletePytmentMethodRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'method' => 'required|exists:pytment_methods,method',
        ];
    }
}
