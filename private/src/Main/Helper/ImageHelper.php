<?php
namespace Main\Helper;

class ImageHelper
{
  static private $x = 800, $y = 600;

  static public function makeResizeWatermark($path)
  {
    $pinfo = pathinfo($path);
    $image = self::createResource($path, $pinfo['extension']);
    $image = self::resizeResource($image);
    $image = self::watermarkResource($image);
    self::save($image, $path, $pinfo['extension']);
  }

  static public function resizeResource($image)
  {
    $image_fin = imagecreatetruecolor(self::$x, self::$y);
    $imgX = imagesx($image);
    $imgY = imagesy($image);

    imagecopyresized(
      $image_fin,
      $image,
      0,
      0,
      0,
      0,
      self::$x,
      self::$y,
      $imgX,
      $imgY
    );

    imagedestroy($image);
    return $image_fin;
  }

  static public function watermarkResource($image)
  {
    $watermark = self::getWtmResource();
    $imgX = imagesx($image);
    $imgY = imagesy($image);
    $wtmX = imagesx($watermark);
    $wtmY = imagesy($watermark);

    imagecopyresized(
      $image,
      $watermark,
      round($imgX/2 - $wtmX/2),
      round($imgY/2 - $wtmY/2),
      0,
      0,
      $wtmX,
      $wtmY,
      $wtmX,
      $wtmY
    );

    imagedestroy($watermark);
    return $image;
  }

  static public function createResource($path, $ext)
  {
    if(in_array($ext, ['jpg', 'jpeg'])) {
      return imagecreatefromjpeg($path);
    }
    else if($ext == "png") {
      return imagecreatefrompng($path);
    }
    else if($ext == "gif") {
      return imagecreatefromgif($path);
    }
    else {
      return false;
    }
  }

  static public function getWtmResource()
  {
    return imagecreatefrompng("private/resource/watermark.png");
  }

  static public function save($image, $path, $ext)
  {
    if(in_array($ext, ['jpg', 'jpeg'])) {
      return imagejpeg($image, $path);
    }
    else if($ext == "png") {
      return imagepng($image, $path);
    }
    else if($ext == "gif") {
      return imagegif($image, $path);
    }
    else {
      return false;
    }
  }
}
