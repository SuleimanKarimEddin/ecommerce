<?php

namespace Modules\Product\Services\Dashboard;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Modules\Base\Interface\ImageServiceInterface;
use Modules\Base\Services\BaseCrudService;
use Modules\Product\Models\ProductVariation;

class ProductVariationImage extends BaseCrudService
{
    public function __construct(protected ImageServiceInterface $imageServiceInterface)
    {
        parent::__construct(new ProductVariation);
    }

    public function create($data): Model
    {
        $user = auth()->user();
        $imageFieldName = 'image';
        $image = $this->imageServiceInterface->saveImage($data[$imageFieldName]);

        return $this->model->create(

            [
                $imageFieldName => $image,

            ]
        );
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

    public function delete(int $id)
    {

        $object = $this->findByID($id);
        $this->imageServiceInterface->DeleteImage($object['main_image']);

        return (bool) $object->delete();

    }
}
