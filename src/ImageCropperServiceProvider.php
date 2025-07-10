<?php

namespace MynulLeo\ImageCropper;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

class ImageCropperServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register component
        Blade::component('image-cropper', \MynulLeo\ImageCropper\View\Components\ImageCropper::class);

        // Load views from package (if you have any Blade views)
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'image-cropper');

        // Load routes if needed (optional)
        if (file_exists(__DIR__ . '/../routes/web.php')) {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        }

        // Publish assets if developer wants to copy manually to public/vendor
        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('vendor/image-cropper'),
        ], 'image-cropper-assets');

        // Load package assets directly from package
        $this->publishes([
            __DIR__ . '/../resources/css' => resource_path('css/vendor/image-cropper'),
            __DIR__ . '/../resources/js' => resource_path('js/vendor/image-cropper'),
        ], 'image-cropper-resources');

        // Add a view namespace if needed
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'image-cropper');
    }

    public function register()
    {
        //
    }
}