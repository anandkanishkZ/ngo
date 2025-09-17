<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'label',
        'value',
        'icon',
        'color',
        'sort_order',
        'is_active',
        'description'
    ];

    protected $casts = [
        'value' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    // Clear cache when statistics are modified
    protected static function booted()
    {
        static::saved(fn() => Cache::forget('homepage_statistics'));
        static::deleted(fn() => Cache::forget('homepage_statistics'));
    }

    // Get active statistics for homepage
    public static function getActiveStats()
    {
        return Cache::remember('homepage_statistics', 3600, function() {
            return static::where('is_active', true)
                        ->orderBy('sort_order')
                        ->orderBy('id')
                        ->get();
        });
    }

    // Get statistic value by key
    public static function getValueByKey($key, $default = 0)
    {
        $stat = static::where('key', $key)->where('is_active', true)->first();
        return $stat ? $stat->value : $default;
    }

    // Increment statistic value
    public static function incrementValue($key, $amount = 1)
    {
        $stat = static::where('key', $key)->first();
        if ($stat) {
            $stat->increment('value', $amount);
            Cache::forget('homepage_statistics');
        }
    }
}
