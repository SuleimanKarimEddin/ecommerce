<?php

namespace Modules\Product\Services\Dashboard;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Modules\Base\Services\BaseCrudService;
use Modules\Product\Models\Product;

class ProductService extends BaseCrudService
{
    public function __construct()
    {
        parent::__construct(new Product);
    }

    public function create($data): Model
    {
        $user = auth()->user();

        return $this->model->create(array_merge($data,
            [
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]
        ));

    }

    public function update(int $id, array $data): bool
    {
        $user = auth()->user();
        $Updated = $this->model->where('id', $id)->update(
            array_merge($data, ['created_by' => $user->id, 'updated_by' => $user->id]));
        if ((bool) $Updated) {
            return true;
        }
        throw new Exception('not_Found');
    }
}
