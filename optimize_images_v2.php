<?php
ini_set('memory_limit', '512M');

function optimizeImage($source, $destination, $targetWidth) {
    if (!file_exists($source)) {
        echo "Source file not found: $source\n";
        return false;
    }

    $info = getimagesize($source);
    if (!$info) {
        echo "Could not get image info for $source\n";
        return false;
    }

    list($width, $height, $type) = $info;
    
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
        echo "Unsupported image type: $type\n";
        return false;
    }
    
    if (!$sourceImage) {
        echo "Failed to create image resource from $source\n";
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

// Paths - Use standard separators
$basePath = __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
$logoLight = $basePath . 'logolight.png';
$logoOptimized = $basePath . 'logolight_opt.png';

echo "Base path: $basePath\n";

// Optimize Logo
if (file_exists($logoLight)) {
    echo "Optimizing logolight.png...\n";
    if (optimizeImage($logoLight, $logoOptimized, 400)) { // Resize to 400px width
        echo "Success! Created logolight_opt.png\n";
    } else {
        echo "Failed to optimize logolight.png\n";
    }
} else {
    echo "logolight.png not found at $logoLight\n";
}
