<?php

namespace Modules\Product\Services;

use Modules\Base\Services\BaseCrudService;
use Modules\Product\Models\AttributeValue;

class AttributeValueService extends BaseCrudService
{
    public function __construct()
    {
        parent::__construct(new AttributeValue);
    }

    public function updateAttributeValue(string $id, array $data): bool
    {
        AttributeValue::where('value', $id)->update([
            'value' => $data['value'],
            'attribute_name' => $data['attribute_name'],
        ]);

        return true;
    }

    public function deleteAttributeValue(string $id): bool
    {
        AttributeValue::where('value', $id)->delete();

        return true;
    }
}
