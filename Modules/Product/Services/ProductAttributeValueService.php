<?php

namespace Modules\Product\Services;

use Modules\Base\Services\BaseCrudService;
use Modules\Product\Models\ProductAttributeValue;

class ProductAttributeValueService extends BaseCrudService
{
    public function __construct()
    {
        parent::__construct(new ProductAttributeValue);
    }
}
