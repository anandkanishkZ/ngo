<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait ImageOptimizationTrait
{
    /**
     * Convert image to WebP format
     */
    public function convertToWebP($imagePath, $quality = 80)
    {
        $pathInfo = pathinfo($imagePath);
        $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
        
        if (file_exists(public_path($imagePath))) {
            $image = Image::make(public_path($imagePath));
            $image->encode('webp', $quality)->save(public_path($webpPath));
            return $webpPath;
        }
        
        return null;
    }

    /**
     * Generate responsive image sizes
     */
    public function generateResponsiveImages($imagePath, $sizes = [400, 800, 1200, 1600])
    {
        $pathInfo = pathinfo($imagePath);
        $responsiveImages = [];
        
        if (file_exists(public_path($imagePath))) {
            $image = Image::make(public_path($imagePath));
            
            foreach ($sizes as $size) {
                $resizedPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '-' . $size . 'w.' . $pathInfo['extension'];
                $resizedImage = clone $image;
                $resizedImage->resize($size, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $resizedImage->save(public_path($resizedPath), 80);
                $responsiveImages[$size] = $resizedPath;
                
                // Also create WebP version
                $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '-' . $size . 'w.webp';
                $resizedImage->encode('webp', 80)->save(public_path($webpPath));
                $responsiveImages[$size . '_webp'] = $webpPath;
            }
        }
        
        return $responsiveImages;
    }

    /**
     * Get optimized image tag with srcset and WebP support
     */
    public function getOptimizedImageTag($imagePath, $alt = '', $class = '', $loading = 'lazy')
    {
        $pathInfo = pathinfo($imagePath);
        $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
        
        $html = '<picture>';
        
        // WebP source
        if (file_exists(public_path($webpPath))) {
            $html .= '<source type="image/webp" srcset="' . asset($webpPath) . '">';
        }
        
        // Fallback image
        $html .= '<img src="' . asset($imagePath) . '" alt="' . htmlspecialchars($alt) . '" class="' . $class . '" loading="' . $loading . '" decoding="async">';
        $html .= '</picture>';
        
        return $html;
    }

    /**
     * Optimize existing image
     */
    public function optimizeImage($imagePath, $maxWidth = 1600, $quality = 80)
    {
        if (file_exists(public_path($imagePath))) {
            $image = Image::make(public_path($imagePath));
            
            // Resize if larger than max width
            if ($image->width() > $maxWidth) {
                $image->resize($maxWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }
            
            // Save optimized version
            $image->save(public_path($imagePath), $quality);
            
            // Create WebP version
            $this->convertToWebP($imagePath, $quality);
            
            return true;
        }
        
        return false;
    }
}
