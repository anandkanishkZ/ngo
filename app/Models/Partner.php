<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'logo',
        'website_url',
        'is_active',
        'sort_order',
        'type', // sponsor, partner, collaborator
        'featured',
        'background_color',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'featured' => 'boolean',
    ];

    /**
     * Get active partners with caching
     */
    public static function getActivePartners()
    {
        return Cache::remember('partners_active', 3600, function () {
            return self::where('is_active', true)
                      ->orderBy('featured', 'desc')
                      ->orderBy('sort_order')
                      ->orderBy('name')
                      ->get();
        });
    }

    /**
     * Get featured partners
     */
    public static function getFeaturedPartners()
    {
        return Cache::remember('partners_featured', 3600, function () {
            return self::where('is_active', true)
                      ->where('featured', true)
                      ->orderBy('sort_order')
                      ->orderBy('name')
                      ->get();
        });
    }

    /**
     * Get partners by type
     */
    public static function getPartnersByType($type)
    {
        return Cache::remember("partners_{$type}", 3600, function () use ($type) {
            return self::where('is_active', true)
                      ->where('type', $type)
                      ->orderBy('featured', 'desc')
                      ->orderBy('sort_order')
                      ->orderBy('name')
                      ->get();
        });
    }

    /**
     * Get logo URL - BSH Pattern
     */
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            // Strip folder prefix if present (for backwards compatibility)
            $filename = basename($this->logo);
            return asset('uploads/partners/' . $filename);
        }
        
        // Return placeholder if no logo
        $name = urlencode($this->name);
        $bg = str_replace('#', '', $this->background_color ?: '3498db');
        return "https://via.placeholder.com/200x100/{$bg}/ffffff?text={$name}";
    }

    /**
     * Boot method to handle cache invalidation
     */
    protected static function booted()
    {
        static::saved(function () {
            self::clearCache();
        });

        static::deleted(function () {
            self::clearCache();
        });
    }

    /**
     * Clear all partner-related cache
     */
    public static function clearCache()
    {
        Cache::forget('partners_active');
        Cache::forget('partners_featured');
        Cache::forget('partners_sponsor');
        Cache::forget('partners_partner');
        Cache::forget('partners_collaborator');
    }

    /**
     * Scope for active partners
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured partners
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope for partners by type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
