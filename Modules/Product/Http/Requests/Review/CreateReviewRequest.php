<?php

namespace Modules\Product\Http\Requests\Review;

use Modules\Base\Http\Requests\BaseRequest;

class CreateReviewRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'rate' => 'required|min:1|max:5',
            'comment' => 'required|string',
            'product_id' => 'required|numeric|exists:products,id',
        ];
    }
}
