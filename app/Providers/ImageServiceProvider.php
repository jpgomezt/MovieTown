<?php

namespace App\Providers;

use App\Interfaces\ImageStorage;
use App\Util\ImageLocalStorage;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImageStorage::class, function () {
            return new ImageLocalStorage();
        });
    }
}
