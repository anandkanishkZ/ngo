<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_url',
        'subtitle',
        'title_color',
        'subtitle_color',
        'title_size',
        'subtitle_size',
        'button1_text',
        'button1_url',
        'button1_style',
        'button2_text',
        'button2_url',
        'button2_style',
        'bg_image',
        'bg_image_id', // Add media library support
        'text_position',
        'vertical_position',
        'animation',
        'animation_duration',
        'overlay_enabled',
        'position',
        'is_active',
    ];

    /**
     * Get background image URL attribute - BSH Pattern
     */
    public function getBackgroundImageUrlAttribute()
    {
        if ($this->bg_image) {
            // Strip folder prefix if present (for backwards compatibility)
            $filename = basename($this->bg_image);
            return asset('uploads/hero/' . $filename);
        }
        return null;
    }
}
