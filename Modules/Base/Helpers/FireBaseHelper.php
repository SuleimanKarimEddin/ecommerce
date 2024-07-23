<?php

namespace Modules\Base\Helpers;

use Kreait\Firebase\Factory;

class FireBaseHelper
{
    private $storage;

    public function __construct()
    {
        $this->storage = (new Factory)
            ->withServiceAccount(base_path('public/credentials/firebase_credentials.json'))
            ->withDefaultStorageBucket('laravel-images-d2bd8.appspot.com')
            ->createStorage();
    }

    public function getBucket()
    {
        return $this->storage->getBucket();
    }
}
