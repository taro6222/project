<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gif extends MX_Controller
{
    private $ci;

    public function __construct()
    {
        parent::__construct();
    }

    public function resize($file)
    {
        $crop_w = 0;
        $crop_h = 0;
        $crop_x = 0;
        $crop_y = 0;
        $image = new Imagick($file);
        $originalWidth = @$image->getImageWidth();
        $originalHeight = @$image->getImageHeight();
        //$size_w = ($originalWidth*$percent)/100;
        //$size_h = ($originalHeight*$percent)/100;
        $size_w = 100;
        $size_h = 100;
        if (($size_w - $originalWidth) > ($size_h - $originalHeight)) {
            $s = $size_h / $originalHeight;
            $size_w = @round($originalWidth * $s);
            $size_h = @round($originalHeight * $s);
        } else {
            $s = $size_w / $originalWidth;
            $size_w = @round($originalWidth * $s);
            $size_h = @round($originalHeight * $s);
        }
        $image = @$image->coalesceImages();

        foreach ($image as $frame) {
            @$frame->cropImage($crop_w, $crop_h, $crop_x, $crop_y);
            @$frame->thumbnailImage($size_h, $size_w);
            @$frame->setImagePage($size_h, $size_w, 0, 0);
        }
        $imageContent = @$image->getImagesBlob();
        /*
        $fp = fopen($file_dest,'w');
        fwrite($fp,$imageContent);
        fclose($fp);
        */
        return $imageContent;
    }
}