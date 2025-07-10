<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use MynulLeo\ImageCropper\View\Components\ImageCropper;

class ImageCropperServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('image-cropper', ImageCropper::class);
    }
}