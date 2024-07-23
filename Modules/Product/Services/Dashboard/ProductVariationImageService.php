<?php

namespace Modules\Product\Services\Dashboard;

use Illuminate\Database\Eloquent\Model;
use Modules\Base\Interface\ImageServiceInterface;
use Modules\Base\Services\BaseCrudService;
use Modules\Product\Models\ProductVariationImage;

class ProductVariationImageService extends BaseCrudService
{
    public function __construct(protected ImageServiceInterface $imageServiceInterface)
    {
        parent::__construct(new ProductVariationImage);
    }

    public function create($data): Model
    {
        $imageFieldName = 'image';
        $image = $this->imageServiceInterface->saveImage($data[$imageFieldName]);

        $variation_id = $data['variation_id'];
        $is_active = $data['is_active'] ?? 1;
        $is_main_image = $data['is_main_image'] ?? 0;

        return ProductVariationImage::create([
            'variation_id' => $variation_id,
            'image' => $image,
            'is_active' => $is_active,
            'is_main_image' => $is_main_image,
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $imageFieldName = 'image';
        $object = $this->findByID($id);
        if (isset($data[$imageFieldName])) {
            $image = $this->imageServiceInterface->UpdateImage($data['image'], $object[$imageFieldName]);
            $object->update(array_merge($data, [
                $imageFieldName => $image,
            ]));

            return true;
        }

        $object->update($data);

        return true;

    }

    public function delete(int $id)
    {

        $object = $this->findByID($id);
        $this->imageServiceInterface->DeleteImage($object['image']);

        return (bool) $object->delete();

    }
}
