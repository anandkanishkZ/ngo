<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use App\Traits\MediaUrlTrait;

class Notice extends Model
{
    use HasFactory, MediaUrlTrait;

    protected $fillable = [
        'title',
        'content', 
        'excerpt',
        'image',
        'author',
        'priority',
        'status',
        'category',
        'expires_at',
        'is_featured',
        'is_active',
        'sort_order',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'expires_at' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeNotExpired(Builder $query): Builder
    {
        return $query->where(function($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>=', now());
        });
    }

    public function scopeByPriority(Builder $query, string $priority = null): Builder
    {
        if ($priority) {
            return $query->where('priority', $priority);
        }
        return $query->orderByRaw("FIELD(priority, 'urgent', 'high', 'medium', 'low')");
    }

    public function scopeByCategory(Builder $query, string $category = null): Builder
    {
        if ($category) {
            return $query->where('category', $category);
        }
        return $query;
    }

    // Static methods for frontend use
    public static function getActiveNotices(int $limit = null)
    {
        $cacheKey = 'notices_active' . ($limit ? "_limit_{$limit}" : '');
        
        return Cache::remember($cacheKey, 3600, function() use ($limit) {
            $query = static::active()
                          ->published()
                          ->notExpired()
                          ->orderBy('sort_order')
                          ->orderBy('published_at', 'desc');
            
            if ($limit) {
                $query->limit($limit);
            }
            
            return $query->get();
        });
    }

    public static function getFeaturedNotices(int $limit = 5)
    {
        return Cache::remember('notices_featured', 3600, function() use ($limit) {
            return static::active()
                        ->published()
                        ->featured()
                        ->notExpired()
                        ->orderBy('sort_order')
                        ->orderBy('published_at', 'desc')
                        ->limit($limit)
                        ->get();
        });
    }

    public static function getUrgentNotices()
    {
        return Cache::remember('notices_urgent', 1800, function() {
            return static::active()
                        ->published()
                        ->byPriority('urgent')
                        ->notExpired()
                        ->orderBy('published_at', 'desc')
                        ->get();
        });
    }

    // Accessors
    public function getPriorityBadgeAttribute(): string
    {
        $badges = [
            'urgent' => 'badge-danger',
            'high' => 'badge-warning', 
            'medium' => 'badge-info',
            'low' => 'badge-secondary'
        ];
        
        return $badges[$this->priority] ?? 'badge-secondary';
    }

    public function getStatusBadgeAttribute(): string
    {
        $badges = [
            'published' => 'badge-success',
            'draft' => 'badge-secondary',
            'archived' => 'badge-dark'
        ];
        
        return $badges[$this->status] ?? 'badge-secondary';
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    // Cache clearing methods
    public static function clearCache()
    {
        $keys = [
            'notices_active',
            'notices_active_limit_3',
            'notices_active_limit_5',
            'notices_active_limit_6',
            'notices_featured',
            'notices_urgent'
        ];
        
        foreach ($keys as $key) {
            Cache::forget($key);
        }
    }

    /**
     * Get notice image URL
     */
    public function getImageUrlAttribute()
    {
        return $this->generateMediaUrl($this->image, 'public');
    }

    protected static function boot()
    {
        parent::boot();
        
        static::saved(function () {
            static::clearCache();
        });
        
        static::deleted(function () {
            static::clearCache();
        });
    }
}
