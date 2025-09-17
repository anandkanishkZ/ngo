<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\MediaUrlTrait;

class Project extends Model
{
    use HasFactory, MediaUrlTrait;

    protected $fillable = [
        'title',
        'description',
        'detailed_description',
        'status',
        'category',
        'start_date',
        'end_date',
        'budget',
        'funds_raised',
        'location',
        'images',
        'featured_image',
        'beneficiaries',
        'goals',
        'achievements',
        'partners',
        'is_featured',
        'is_active',
        'sort_order',
        'slug'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'budget' => 'decimal:2',
        'funds_raised' => 'decimal:2',
        'images' => 'array',
        'partners' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean'
    ];

    // Automatically generate slug when creating
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    // Scopes
    public function scopeOngoing($query)
    {
        return $query->where('status', 'ongoing')->where('is_active', true);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed')->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessors
    public function getFundingProgressAttribute()
    {
        if (!$this->budget || $this->budget == 0) {
            return 0;
        }
        return round(($this->funds_raised / $this->budget) * 100, 2);
    }

    public function getStatusBadgeAttribute()
    {
        return $this->status === 'completed' ? 'success' : 'primary';
    }

    /**
     * Get featured image URL
     */
    public function getFeaturedImageUrlAttribute()
    {
        return $this->generateMediaUrl($this->featured_image, 'public');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
