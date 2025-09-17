<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ImpactArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description', 
        'icon',
        'color',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Get active impact areas ordered by sort_order
     */
    public static function getActiveAreas()
    {
        return Cache::remember('impact_areas_active', 3600, function () {
            return self::where('is_active', true)
                      ->orderBy('sort_order')
                      ->get();
        });
    }

    /**
     * Boot method to clear cache when model is saved or deleted
     */
    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('impact_areas_active');
        });

        static::deleted(function () {
            Cache::forget('impact_areas_active');
        });
    }
}
