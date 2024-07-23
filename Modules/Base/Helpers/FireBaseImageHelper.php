<?php

namespace Modules\Base\Helpers;

use Illuminate\Http\UploadedFile;
use Modules\Base\Interface\ImageServiceInterface;

class FireBaseImageHelper implements ImageServiceInterface
{
    public function __construct(private FireBaseHelper $firebaseHelper) {}

    /**
     * Save an image to Firebase storage.
     *
     * @param  \Illuminate\Http\UploadedFile  $image  The uploaded image file.
     */
    public function saveImage(UploadedFile $image): string
    {
        $filePath = $image->getRealPath();
        $imageName = $image->getClientOriginalName();
        $firebasePath = 'images/'.$imageName;

        $bucket = $this->firebaseHelper->getBucket();

        $bucket->upload(
            fopen($filePath, 'r'),
            [
                'name' => $firebasePath,
            ]);

        $imageReference = $bucket->object($firebasePath);
        $imageUrl = $imageReference->signedUrl(new \DateTime('2099-12-12'));

        return $imageUrl;
    }

    /**
     * Delete an image from Firebase storage.
     *
     * @param  string  $imageName  The name of the image to delete.
     *
     * @throws \Exception If the image does not exist.
     */
    public function DeleteImage(string $url): void
    {
        $imageName = $this->getImageNameFromUrl($url);
        $firebasePath = 'images/'.$imageName;

        $object = $this->firebaseHelper->getBucket()->object($firebasePath);
        if ($object->exists()) {
            $object->delete();

            return;
        } else {
            throw new \Exception('image does not exist');
        }
    }

    /**
     * Update an image in Firebase storage.
     *
     * @param  \Illuminate\Http\UploadedFile  $image  The uploaded image file.
     * @param  string  $oldUrl  The name of the old image to replace.
     *
     * @throws \Exception If the old image does not exist.
     */
    public function UpdateImage(UploadedFile $image, string $oldUrl): string
    {
        $oldImageName = $this->getImageNameFromUrl($oldUrl);
        $filePath = $image->getRealPath();
        $fileName = $image->getClientOriginalName();
        $firebasePath = 'images/'.$fileName;

        $oldFirebasePath = 'images/'.$oldImageName;

        $bucket = $this->firebaseHelper->getBucket();
        $bucket->upload(
            fopen($filePath, 'r'),
            [
                'name' => $firebasePath,
            ]
        );

        $oldObject = $bucket->object($oldFirebasePath);
        if ($oldObject->exists()) {
            $oldObject->delete();
        }
        $newImageReference = $bucket->object($firebasePath);
        $newImageUrl = $newImageReference->signedUrl(new \DateTime('2099-12-12'));

        return $newImageUrl;
    }

    private function getImageNameFromUrl(string $url): string
    {
        $url = explode('/images/', $url);
        $url = explode('?', $url[1]);

        return $url[0];
    }
}
