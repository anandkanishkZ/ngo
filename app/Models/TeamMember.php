<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'bio',
        'image',
        'email',
        'phone',
        'linkedin_url',
        'twitter_url',
        'facebook_url',
        'is_active',
        'sort_order',
        'featured',
        'department',
        'joined_date',
        'achievements',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'featured' => 'boolean',
        'joined_date' => 'date',
    ];

    /**
     * Get team member image URL - BSH Pattern
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // Strip folder prefix if present (for backwards compatibility)
            $filename = basename($this->image);
            return asset('uploads/team/' . $filename);
        }
        return asset('images/default-avatar.jpg');
    }

    /**
     * Get active team members
     */
    public static function getActiveMembers()
    {
        return Cache::remember('team_members_active', 60 * 15, function () {
            return self::where('is_active', true)
                ->orderBy('sort_order', 'asc')
                ->orderBy('name', 'asc')
                ->get();
        });
    }

    /**
     * Get featured team members
     */
    public static function getFeaturedMembers($limit = null)
    {
        $query = self::where('is_active', true)
            ->where('featured', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc');

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * Get team members by department
     */
    public static function getByDepartment($department)
    {
        return Cache::remember("team_members_dept_{$department}", 60 * 15, function () use ($department) {
            return self::where('is_active', true)
                ->where('department', $department)
                ->orderBy('sort_order', 'asc')
                ->orderBy('name', 'asc')
                ->get();
        });
    }

    /**
     * Get all departments
     */
    public static function getDepartments()
    {
        return self::whereNotNull('department')
            ->where('is_active', true)
            ->distinct()
            ->pluck('department')
            ->sort()
            ->values();
    }

    /**
     * Clear team members cache
     */
    public static function clearCache()
    {
        Cache::forget('team_members_active');
        
        // Clear department caches
        $departments = ['leadership', 'program', 'finance', 'marketing', 'operations'];
        foreach ($departments as $dept) {
            Cache::forget("team_members_dept_{$dept}");
        }
    }

    /**
     * Boot method to clear cache on model changes
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            self::clearCache();
        });

        static::deleted(function () {
            self::clearCache();
        });
    }

    /**
     * Get years of experience (from joined_date)
     */
    public function getYearsOfExperienceAttribute()
    {
        if (!$this->joined_date) {
            return null;
        }

        return $this->joined_date->diffInYears(now());
    }

    /**
     * Get formatted joined date
     */
    public function getFormattedJoinedDateAttribute()
    {
        if (!$this->joined_date) {
            return null;
        }

        return $this->joined_date->format('F Y');
    }

    /**
     * Check if member has social media links
     */
    public function getHasSocialLinksAttribute()
    {
        return !empty($this->linkedin_url) || 
               !empty($this->twitter_url) || 
               !empty($this->facebook_url);
    }

    /**
     * Get social media links as array
     */
    public function getSocialLinksAttribute()
    {
        $links = [];

        if ($this->linkedin_url) {
            $links['linkedin'] = [
                'url' => $this->linkedin_url,
                'icon' => 'fab fa-linkedin',
                'name' => 'LinkedIn'
            ];
        }

        if ($this->twitter_url) {
            $links['twitter'] = [
                'url' => $this->twitter_url,
                'icon' => 'fab fa-twitter',
                'name' => 'Twitter'
            ];
        }

        if ($this->facebook_url) {
            $links['facebook'] = [
                'url' => $this->facebook_url,
                'icon' => 'fab fa-facebook',
                'name' => 'Facebook'
            ];
        }

        return $links;
    }

    /**
     * Get department badge color
     */
    public function getDepartmentColorAttribute()
    {
        $colors = [
            'leadership' => 'primary',
            'program' => 'success',
            'finance' => 'warning',
            'marketing' => 'info',
            'operations' => 'secondary',
        ];

        return $colors[$this->department] ?? 'secondary';
    }
}
