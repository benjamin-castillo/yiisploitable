<?php
namespace app\repositories;


class ImagesRepo
{

    public static function Resize($sourcePath, $destPath, $newWidth, $newHeight)
    {
        // Get original image dimensions
        list($width, $height) = getimagesize($sourcePath);

        // Create a new true color image
        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        // Load the source image
        $imageType = exif_imagetype($sourcePath);
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $sourceImage = imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $sourceImage = imagecreatefrompng($sourcePath);
                break;
            case IMAGETYPE_GIF:
                $sourceImage = imagecreatefromgif($sourcePath);
                break;
            default:
                throw new Exception('Unsupported image type');
        }

        // Resize the image
        imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Save the resized image
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                imagejpeg($newImage, $destPath);
                break;
            case IMAGETYPE_PNG:
                imagepng($newImage, $destPath);
                break;
            case IMAGETYPE_GIF:
                imagegif($newImage, $destPath);
                break;
        }

        // Free up memory
        imagedestroy($newImage);
        imagedestroy($sourceImage);
    }

}