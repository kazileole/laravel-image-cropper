<?php

namespace MynulLeo\ImageCropper\View\Components;

use Illuminate\View\Component;

class ImageCropper extends Component
{
    public string $inputId;
    public string $previewId;
    public string $outputName;
    public float $ratio;

    public function __construct(
        string $inputId,
        string $previewId,
        string $outputName = 'cropped_image',
        string $ratio = '816/484'
    ) {
        $this->inputId = $inputId;
        $this->previewId = $previewId;
        $this->outputName = $outputName;

        // Convert ratio (e.g. 816/484) to float
        [$w, $h] = explode('/', $ratio);
        $this->ratio = round(floatval($w) / floatval($h), 4);
    }

    public function render()
    {
        return view('image-cropper::component');
    }
}