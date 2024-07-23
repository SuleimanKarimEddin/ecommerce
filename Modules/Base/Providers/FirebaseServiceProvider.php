<?php

namespace Modules\Base\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Modules\Base\Helpers\FireBaseHelper;
use Modules\Base\Helpers\FireBaseImageHelper;
use Modules\Base\Helpers\LocalImageHelper;
use Modules\Base\Interface\ImageServiceInterface;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->singleton(FireBaseHelper::class, function ($app) {
            return new FireBaseHelper();
        });

        $condition = Config::get('base.firebase_images');
        if ($condition) {
            $this->app->bind(ImageServiceInterface::class, FireBaseImageHelper::class);
        } else {
            $this->app->bind(ImageServiceInterface::class, LocalImageHelper::class);
        }
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
