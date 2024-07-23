<?php

namespace Modules\Product\Services;

use Modules\Base\Services\BaseCrudService;
use Modules\Product\Models\Review;

class ReviewService extends BaseCrudService
{
    public function __construct()
    {
        parent::__construct(new Review);

        $this->relations = ['user'];
    }
}
