<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use Modules\Base\Interface\ImageServiceInterface;
use Modules\Base\Services\BaseCrudService;

abstract class BaseServiceWithImage extends BaseCrudService
{
    public string $image_name_request = 'image';

    public string $image_name_model = 'image';

    public string $image_path_location = 'base';

    protected ImageServiceInterface $imageService;

    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->filterable = [];
        $this->imageService = app(ImageServiceInterface::class);
    }

    public function create(array $data): Model
    {
        $image = $this->imageService->saveImage($data[$this->image_name_request]);

        return $this->model->create(array_merge($data, [
            $this->image_name_model => $image,
        ]));
    }

    public function edit(int $id, array $data): bool
    {
        $object = $this->findByID($id);
        $image = $object[$this->image_name_model];
        if (isset($data[$this->image_name_request])) {
            $image = $this->imageService->UpdateImage($data[$this->image_name_request], $image);
        }

        return $object->update(array_merge($data, [
            $this->image_name_model => $image,
        ]));

    }

    public function delete(int $id): bool
    {
        $object = $this->findByID($id);
        $this->imageService->DeleteImage($object[$this->image_name_model]);

        return (bool) $object->delete();
    }
}
