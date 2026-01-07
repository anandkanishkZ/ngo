<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'position',
        'location',
        'employment_type',
        'number_of_positions',
        'experience_required',
        'education_level',
        'salary_range',
        'description',
        'responsibilities',
        'requirements',
        'skills',
        'benefits',
        'how_to_apply',
        'application_email',
        'application_phone',
        'deadline',
        'published_date',
        'is_active',
        'is_urgent',
        'is_featured',
        'views_count',
        'department',
        'category',
    ];

    protected $casts = [
        'deadline' => 'date',
        'published_date' => 'date',
        'is_active' => 'boolean',
        'is_urgent' => 'boolean',
        'is_featured' => 'boolean',
        'number_of_positions' => 'integer',
        'views_count' => 'integer',
    ];

    /**
     * Get active vacancies
     */
    public static function getActiveVacancies()
    {
        return self::where('is_active', true)
            ->where('deadline', '>=', Carbon::today())
            ->orderBy('is_featured', 'desc')
            ->orderBy('is_urgent', 'desc')
            ->orderBy('published_date', 'desc')
            ->get();
    }

    /**
     * Get featured vacancies
     */
    public static function getFeaturedVacancies($limit = 3)
    {
        return self::where('is_active', true)
            ->where('is_featured', true)
            ->where('deadline', '>=', Carbon::today())
            ->orderBy('published_date', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Check if vacancy is expired
     */
    public function isExpired()
    {
        return Carbon::parse($this->deadline)->isPast();
    }

    /**
     * Check if deadline is approaching (within 7 days)
     */
    public function isDeadlineApproaching()
    {
        $daysRemaining = Carbon::today()->diffInDays($this->deadline, false);
        return $daysRemaining >= 0 && $daysRemaining <= 7;
    }

    /**
     * Get days remaining until deadline
     */
    public function getDaysRemaining()
    {
        return Carbon::today()->diffInDays($this->deadline, false);
    }

    /**
     * Get formatted deadline
     */
    public function getFormattedDeadlineAttribute()
    {
        return $this->deadline->format('M d, Y');
    }

    /**
     * Get formatted published date
     */
    public function getFormattedPublishedDateAttribute()
    {
        return $this->published_date ? $this->published_date->format('M d, Y') : null;
    }

    /**
     * Increment views count
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Get skills as array
     */
    public function getSkillsArrayAttribute()
    {
        if (empty($this->skills)) {
            return [];
        }
        
        // If it's JSON
        $decoded = json_decode($this->skills, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }
        
        // If it's comma-separated
        return array_map('trim', explode(',', $this->skills));
    }

    /**
     * Scope to filter by category
     */
    public function scopeByCategory($query, $category)
    {
        if ($category) {
            return $query->where('category', $category);
        }
        return $query;
    }

    /**
     * Scope to filter by department
     */
    public function scopeByDepartment($query, $department)
    {
        if ($department) {
            return $query->where('department', $department);
        }
        return $query;
    }

    /**
     * Scope to search vacancies
     */
    public function scopeSearch($query, $searchTerm)
    {
        if ($searchTerm) {
            return $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('position', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%");
            });
        }
        return $query;
    }
}
