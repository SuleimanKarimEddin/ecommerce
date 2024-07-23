<?php

namespace Modules\Product\Services;

use Modules\Base\Services\BaseCrudService;
use Modules\Product\Models\Attribute;

class AttributeService extends BaseCrudService
{
    public function __construct()
    {
        parent::__construct(new Attribute);
    }

    public function updateAttribute(string $id, array $data): bool
    {
        Attribute::where('name', $id)->update([
            'name' => $data['name'],
        ]);

        return true;
    }

    public function deleteAttribute(string $id): bool
    {
        Attribute::where('name', $id)->delete();

        return true;
    }
}
