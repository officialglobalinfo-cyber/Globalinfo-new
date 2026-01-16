<?php

function optimizeImage($source, $destination, $targetWidth) {
    list($width, $height, $type) = getimagesize($source);
    
    // Calculate new dimensions
    $ratio = $width / $height;
    $targetHeight = $targetWidth / $ratio;
    
    // Create new image
    $newImage = imagecreatetruecolor($targetWidth, $targetHeight);
    
    // Handle transparency for PNG
    if ($type == IMAGETYPE_PNG) {
        imagealphablending($newImage, false);
        imagesavealpha($newImage, true);
        $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
        imagefilledrectangle($newImage, 0, 0, $targetWidth, $targetHeight, $transparent);
        $sourceImage = imagecreatefrompng($source);
    } elseif ($type == IMAGETYPE_JPEG) {
        $sourceImage = imagecreatefromjpeg($source);
    } else {
        return false;
    }
    
    // Resize
    imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
    
    // Save
    if ($type == IMAGETYPE_PNG) {
        imagepng($newImage, $destination, 9); // Max compression for PNG
    } elseif ($type == IMAGETYPE_JPEG) {
        imagejpeg($newImage, $destination, 85); // 85% quality for JPG
    }
    
    imagedestroy($newImage);
    imagedestroy($sourceImage);
    return true;
}

// Paths
$basePath = __DIR__ . '/public/images/';
$logoLight = $basePath . 'logolight.png';
$logoOptimized = $basePath . 'logolight_opt.png';

// Optimize Logo
if (file_exists($logoLight)) {
    echo "Optimizing logolight.png...\n";
    if (optimizeImage($logoLight, $logoOptimized, 400)) { // Resize to 400px width
        echo "Created logolight_opt.png\n";
    } else {
        echo "Failed to optimize logolight.png\n";
    }
} else {
    echo "logolight.png not found\n";
}
