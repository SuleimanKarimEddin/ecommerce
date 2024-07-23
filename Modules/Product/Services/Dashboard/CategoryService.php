<?php

namespace Modules\Product\Services\Dashboard;

use Modules\Base\Interface\ImageServiceInterface;
use Modules\Base\Services\BaseCrudService;
use Modules\Product\Models\Category;

class CategoryService extends BaseCrudService
{
    public function __construct(protected ImageServiceInterface $imageServiceInterface)
    {
        parent::__construct(new Category);
    }

    public function createWithImage($data)
    {
        $image = $this->imageServiceInterface->saveImage($data['image']);
        $name = $data['name'];
        $is_active = $data['is_active'] ?? 0;
        $parent_id = $data['parent_id'] ?? null;

        return Category::create(
            [
                'name' => $name,
                'is_active' => $is_active,
                'parent_id' => $parent_id,
                'image' => $image,

            ]

        );

    }

    public function updateWithImage($id, $data)
    {
        $imageFieldName = 'image';
        $object = $this->findByID($id);
        if (isset($data[$imageFieldName])) {
            $image = $this->imageServiceInterface->UpdateImage($data['image'], $object[$imageFieldName]);
            $object->update(array_merge($data, [
                $imageFieldName => $image,
            ]));
        }

        $object->update($data);
    }

    public function delete(int $id)
    {

        $object = $this->findByID($id);
        $this->imageServiceInterface->DeleteImage($object['image']);

        return (bool) $object->delete();

    }
}
