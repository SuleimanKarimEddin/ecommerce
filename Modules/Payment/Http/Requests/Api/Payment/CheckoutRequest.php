<?php

namespace Modules\Payment\Http\Requests\Api\Payment;

use Modules\Base\Http\Requests\BaseRequest;

class CheckoutRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'payment_method' => 'required|string|exists:payment_methods,method',
            'address_id' => 'required|integer|exists:user_addresses,id',
            'items' => 'required|array',
            'items.*.id' => 'required|integer|exists:product_variations,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.name' => 'required|string|max:255',
        ];
    }
}
