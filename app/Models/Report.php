<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'executive_summary',
        'content',
        'type',
        'category',
        'fiscal_year',
        'report_date',
        'period_start',
        'period_end',
        'cover_image',
        'pdf_file',
        'author',
        'status',
        'is_featured',
        'is_public',
        'sort_order',
        'download_count',
        'metadata',
        'published_at',
    ];

    protected $casts = [
        'report_date' => 'date',
        'period_start' => 'date',
        'period_end' => 'date',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_public' => 'boolean',
        'sort_order' => 'integer',
        'download_count' => 'integer',
        'metadata' => 'array',
    ];

    // Scopes
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public function scopePublic(Builder $query): Builder
    {
        return $query->where('is_public', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeByType(Builder $query, string $type = null): Builder
    {
        if ($type) {
            return $query->where('type', $type);
        }
        return $query;
    }

    public function scopeByCategory(Builder $query, string $category = null): Builder
    {
        if ($category) {
            return $query->where('category', $category);
        }
        return $query;
    }

    public function scopeByFiscalYear(Builder $query, string $fiscalYear = null): Builder
    {
        if ($fiscalYear) {
            return $query->where('fiscal_year', $fiscalYear);
        }
        return $query;
    }

    public function scopeRecent(Builder $query, int $limit = 5): Builder
    {
        return $query->orderBy('report_date', 'desc')
                    ->orderBy('published_at', 'desc')
                    ->limit($limit);
    }

    // Static methods for frontend use
    public static function getPublishedReports(int $limit = null)
    {
        $cacheKey = 'reports_published' . ($limit ? "_limit_{$limit}" : '');
        
        return Cache::remember($cacheKey, 3600, function() use ($limit) {
            $query = static::published()
                          ->public()
                          ->orderBy('sort_order')
                          ->orderBy('report_date', 'desc');
            
            if ($limit) {
                $query->limit($limit);
            }
            
            return $query->get();
        });
    }

    public static function getFeaturedReports(int $limit = 3)
    {
        return Cache::remember('reports_featured', 3600, function() use ($limit) {
            return static::published()
                        ->public()
                        ->featured()
                        ->orderBy('sort_order')
                        ->orderBy('report_date', 'desc')
                        ->limit($limit)
                        ->get();
        });
    }

    public static function getReportsByType(string $type, int $limit = null)
    {
        $cacheKey = "reports_type_{$type}" . ($limit ? "_limit_{$limit}" : '');
        
        return Cache::remember($cacheKey, 3600, function() use ($type, $limit) {
            $query = static::published()
                          ->public()
                          ->byType($type)
                          ->orderBy('report_date', 'desc');
            
            if ($limit) {
                $query->limit($limit);
            }
            
            return $query->get();
        });
    }

    // Accessors
    public function getStatusBadgeAttribute(): string
    {
        $badges = [
            'published' => 'badge-success',
            'draft' => 'badge-secondary',
            'archived' => 'badge-dark'
        ];
        
        return $badges[$this->status] ?? 'badge-secondary';
    }

    public function getTypeBadgeAttribute(): string
    {
        $badges = [
            'annual' => 'badge-primary',
            'quarterly' => 'badge-info',
            'monthly' => 'badge-light',
            'project' => 'badge-warning',
            'financial' => 'badge-success',
            'impact' => 'badge-danger'
        ];
        
        return $badges[$this->type] ?? 'badge-secondary';
    }

    public function getFormattedTypeAttribute(): string
    {
        $types = [
            'annual' => 'Annual Report',
            'quarterly' => 'Quarterly Report',
            'monthly' => 'Monthly Report',
            'project' => 'Project Report',
            'financial' => 'Financial Report',
            'impact' => 'Impact Report'
        ];
        
        return $types[$this->type] ?? ucfirst($this->type) . ' Report';
    }

    /**
     * Get cover image URL - BSH Pattern
     */
    public function getCoverImageUrlAttribute(): string
    {
        if ($this->cover_image) {
            // Strip folder prefix if present (for backwards compatibility)
            $filename = basename($this->cover_image);
            return asset('uploads/reports/' . $filename);
        }
        return asset('images/default-report.jpg');
    }

    /**
     * Get PDF URL - BSH Pattern
     */
    public function getPdfUrlAttribute(): ?string
    {
        if ($this->pdf_file) {
            // Strip folder prefix if present (for backwards compatibility)
            $filename = basename($this->pdf_file);
            return asset('uploads/reports/' . $filename);
        }
        return null;
    }

    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return ceil($wordCount / 200); // Average reading speed: 200 words per minute
    }

    public function getIsPublishedAttribute(): bool
    {
        return $this->status === 'published';
    }

    // Helper methods
    public function incrementDownloadCount(): void
    {
        $this->increment('download_count');
        static::clearCache();
    }

    public function isDownloadable(): bool
    {
        return !empty($this->pdf_file) && $this->status === 'published' && $this->is_public;
    }

    // Cache clearing methods
    public static function clearCache()
    {
        $keys = [
            'reports_published',
            'reports_published_limit_3',
            'reports_published_limit_5',
            'reports_published_limit_6',
            'reports_featured',
            'reports_type_annual',
            'reports_type_quarterly',
            'reports_type_monthly',
            'reports_type_project',
            'reports_type_financial',
            'reports_type_impact'
        ];
        
        foreach ($keys as $key) {
            Cache::forget($key);
        }
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
