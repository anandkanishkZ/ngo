<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait MediaUrlTrait
{
    /**
     * Generate a consistent URL for media files (Production-Ready)
     * 
     * This method handles various path formats and ensures proper URL generation
     * for both local and production environments.
     * 
     * @param string|null $path The file path (can be with or without leading slash)
     * @param string $disk Storage disk name (default: 'public')
     * @return string|null
     */
    public function generateMediaUrl($path, $disk = 'public')
    {
        if (!$path) {
            return null;
        }

        // If it's already a full URL (http/https), return as is
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Normalize the path - remove leading slashes
        $path = ltrim($path, '/');
        
        // If path starts with 'uploads/', it's in public folder (like hero slides)
        if (Str::startsWith($path, 'uploads/')) {
            return asset($path);
        }
        
        // Otherwise, check storage disk (legacy)
        $path = preg_replace('#^(storage/|public/)#', '', $path);

        // Check if file exists in storage
        if (Storage::disk($disk)->exists($path)) {
            // Use asset() for proper URL generation with APP_URL
            return asset('storage/' . $path);
        }

        // Log missing files in debug mode
        if (config('app.debug')) {
            \Log::warning("Media file not found: {$path} in disk: {$disk}");
        }

        return null;
    }

    /**
     * Get media URL with fallback
     * 
     * @param string|null $path The file path
     * @param string|null $fallback Fallback URL if file doesn't exist
     * @param string $disk Storage disk name (default: 'public')
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