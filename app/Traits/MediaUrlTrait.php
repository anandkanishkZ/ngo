<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait MediaUrlTrait
{
    /**
     * Generate a consistent URL for media files
     * 
     * @param string|null $path
     * @param string $disk
     * @return string|null
     */
    public function generateMediaUrl($path, $disk = 'public')
    {
        if (!$path) {
            return null;
        }

        // If it's already a full URL, return as is
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Remove any leading slash to ensure consistent path
        $path = ltrim($path, '/');

        // Check if file exists in storage and generate asset URL
        if (Storage::disk($disk)->exists($path)) {
            return asset('storage/' . $path);
        }

        // For debugging: log missing files (optional)
        if (config('app.debug')) {
            \Log::warning("Media file not found: {$path} in disk: {$disk}");
        }

        return null;
    }

    /**
     * Get media URL with fallback
     * 
     * @param string|null $path
     * @param string|null $fallback
     * @param string $disk
     * @return string|null
     */
    public function getMediaUrlWithFallback($path, $fallback = null, $disk = 'public')
    {
        $url = $this->generateMediaUrl($path, $disk);
        
        if (!$url && $fallback) {
            return $fallback;
        }
        
        return $url;
    }
}