<?php

namespace Modules\Base\Helpers;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Modules\Base\Interface\ImageServiceInterface;

class LocalImageHelper implements ImageServiceInterface
{
    public function saveImage(UploadedFile $image)
    {

        $image_path_without_public = '/images/'.'/';
        $image_path = public_path().'/images/'.'/';
        $image_name = '_'.Str::uuid().'.'.$image->getClientOriginalExtension();
        $image->move($image_path, $image_name);

        return $image_path_without_public.$image_name;
    }

    public function UpdateImage(UploadedFile $image, string $oldImageName)
    {
        $new_image_path_without_public = '/images/'.'/';
        $new_image_path = public_path().'/images/'.'/';
        $new_image_name = '_'.Str::uuid().'.'.$image->getClientOriginalExtension();
        $image->move($new_image_path, $new_image_name);
        try {
            unlink(public_path().$oldImageName);

            return $new_image_path_without_public.$new_image_name;
        } catch (Exception $e) {
            return $new_image_path_without_public.$new_image_name;
        }
    }

    public function DeleteImage(string $imageName)
    {
        try {
            unlink(public_path().$imageName);

            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}
