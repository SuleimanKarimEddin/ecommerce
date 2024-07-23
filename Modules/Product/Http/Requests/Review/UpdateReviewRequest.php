<?php

namespace Modules\Product\Http\Requests\Review;

use Modules\Base\Http\Requests\BaseRequest;

class UpdateReviewRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'rate' => 'required_without_all:comment|min:1|max:5',
            'comment' => 'required_without_all:rate',
            'product_id' => 'required|numeric|exists:products,id',
        ];
    }
}
