<?php

namespace MynulLeo\ImageCropper\View\Components;

use Illuminate\View\Component;

class ImageCropper extends Component
{
    public string $inputId;
    public string $previewId;
    public string $ratio;
    public string $outputName;

    public function __construct(string $inputId, string $previewId, string $ratio = '816/484', string $outputName = 'cropped_image')
    {
        $this->inputId = $inputId;
        $this->previewId = $previewId;
        $this->ratio = $ratio;
        $this->outputName = $outputName;
    }

    public function render()
    {
        return view('image-cropper::components.image-cropper', [
            'inputId' => $this->inputId,
            'previewId' => $this->previewId,
            'ratio' => $this->ratio,
            'outputName' => $this->outputName,
        ]);
    }
}