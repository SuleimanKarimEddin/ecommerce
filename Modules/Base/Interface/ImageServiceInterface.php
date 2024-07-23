<?php

namespace Modules\Base\Interface;

use Illuminate\Http\UploadedFile;

interface ImageServiceInterface
{
    public function saveImage(UploadedFile $image);

    public function DeleteImage(string $imageName);

    public function UpdateImage(UploadedFile $image, string $oldImageName);
}
