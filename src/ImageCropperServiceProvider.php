<?php

namespace Mynulleo\ImageCropper;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Mynulleo\ImageCropper\View\Components\ImageCropper;

class ImageCropperServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::component('image-cropper', ImageCropper::class);
    }
}