<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class GalleryPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_id',
        'title',
        'description',
        'category',
        'tags',
        'location',
        'photo_date',
        'photographer',
        'display_order',
        'is_featured',
        'is_active',
        'views_count',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'views_count' => 'integer',
        'display_order' => 'integer',
        'photo_date' => 'date',
    ];

    protected $appends = ['tags_array', 'formatted_photo_date'];

    /**
     * Relationship with Media model
     */
    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * Get active gallery photos
     */
    public static function getActivePhotos()
    {
        return self::where('is_active', true)
            ->with('media')
            ->orderBy('display_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get featured photos
     */
    public static function getFeaturedPhotos($limit = 6)
    {
        return self::where('is_active', true)
            ->where('is_featured', true)
            ->with('media')
            ->orderBy('display_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get photos by category
     */
    public function scopeByCategory($query, $category)
    {
        if ($category && $category !== 'all') {
            return $query->where('category', $category);
        }
        return $query;
    }

    /**
     * Search scope
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    /**
     * Get tags as array
     */
    public function getTagsArrayAttribute()
    {
        if (empty($this->tags)) {
            return [];
        }
        
        return array_map('trim', explode(',', $this->tags));
    }

    /**
     * Get formatted photo date
     */
    public function getFormattedPhotoDateAttribute()
    {
        return $this->photo_date ? $this->photo_date->format('F j, Y') : null;
    }

    /**
     * Increment views count
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Get category options
     */
    public static function getCategoryOptions()
    {
        return [
            'general' => 'General',
            'events' => 'Events & Activities',
            'programs' => 'Programs & Projects',
            'community' => 'Community Impact',
            'infrastructure' => 'Infrastructure',
            'team' => 'Team & Volunteers',
            'beneficiaries' => 'Beneficiaries',
        ];
    }

    /**
     * Get category label
     */
    public function getCategoryLabelAttribute()
    {
        $categories = self::getCategoryOptions();
        return $categories[$this->category] ?? ucfirst($this->category);
    }

    /**
     * Get category badge color
     */
    public function getCategoryBadgeColorAttribute()
    {
        $colors = [
            'general' => 'secondary',
            'events' => 'primary',
            'programs' => 'success',
            'community' => 'info',
            'infrastructure' => 'warning',
            'team' => 'danger',
            'beneficiaries' => 'purple',
        ];
        return $colors[$this->category] ?? 'secondary';
    }

    /**
     * Get similar photos (same category, excluding current)
     */
    public function getSimilarPhotos($limit = 4)
    {
        return self::where('is_active', true)
            ->where('category', $this->category)
            ->where('id', '!=', $this->id)
            ->with('media')
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }
}
