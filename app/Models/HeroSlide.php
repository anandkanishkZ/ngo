<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
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
     * Get the background image from media library
     */
    public function bgImage()
    {
        return $this->belongsTo(Media::class, 'bg_image_id');
    }

    /**
     * Get background image URL - fallback to old system if needed
     */
    public function getBackgroundImageUrl()
    {
        if ($this->bgImage) {
            return $this->bgImage->full_url;
        }
        
        if ($this->bg_image) {
            return asset('storage/' . $this->bg_image);
        }
        
        return null;
    }
}
