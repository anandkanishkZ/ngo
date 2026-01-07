<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Traits\MediaUrlTrait;

class Media extends Model
{
    use HasFactory, MediaUrlTrait;

    protected $fillable = [
        'title',
        'alt_text',
        'filename',
        'original_filename',
        'mime_type',
        'file_size',
        'path',
        'url',
        'width',
        'height',
        'folder',
        'is_image',
        'uploaded_by'
    ];

    protected $casts = [
        'is_image' => 'boolean',
        'file_size' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
    ];

    protected $appends = ['full_url', 'size_formatted'];

    /**
     * Scope for default ordering (latest first)
     */
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc')->orderBy('id', 'desc');
    }

    /**
     * Scope for oldest first
     */
    public function scopeOldestFirst($query)
    {
        return $query->orderBy('created_at', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Scope for alphabetical ordering
     */
    public function scopeAlphabetical($query)
    {
        return $query->orderBy('title', 'asc');
    }

    /**
     * Scope for size ordering (largest first)
     */
    public function scopeBySize($query, $direction = 'desc')
    {
        return $query->orderBy('file_size', $direction);
    }

    /**
     * Get the full URL of the media file
     */
    public function getFullUrlAttribute()
    {
        return $this->generateMediaUrl($this->path, 'public');
    }

    /**
     * Get formatted file size
     */
    public function getSizeFormattedAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Scope to filter by folder
     */
    public function scopeInFolder($query, $folder = null)
    {
        return $query->where('folder', $folder);
    }

    /**
     * Scope to filter by images only
     */
    public function scopeImages($query)
    {
        return $query->where('is_image', true);
    }

    /**
     * Scope to search by title or filename
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('original_filename', 'like', "%{$search}%")
              ->orWhere('alt_text', 'like', "%{$search}%");
        });
    }

    /**
     * Get the user who uploaded this media
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get thumbnail URL for images
     */
    public function getThumbnailUrl($size = 150)
    {
        if (!$this->is_image) {
            return $this->getFileTypeIcon();
        }
        
        // For now, return the full image URL
        // In production, you might want to generate actual thumbnails
        return $this->full_url;
    }

    /**
     * Get file type icon for non-images
     */
    public function getFileTypeIcon()
    {
        $icons = [
            'pdf' => 'fa-file-pdf',
            'doc' => 'fa-file-word',
            'docx' => 'fa-file-word',
            'xls' => 'fa-file-excel',
            'xlsx' => 'fa-file-excel',
            'ppt' => 'fa-file-powerpoint',
            'pptx' => 'fa-file-powerpoint',
            'zip' => 'fa-file-zipper',
            'rar' => 'fa-file-zipper',
            'txt' => 'fa-file-lines',
            'csv' => 'fa-file-csv',
            'mp4' => 'fa-file-video',
            'avi' => 'fa-file-video',
            'mov' => 'fa-file-video',
            'mp3' => 'fa-file-audio',
            'wav' => 'fa-file-audio',
        ];

        $extension = pathinfo($this->filename, PATHINFO_EXTENSION);
        return $icons[$extension] ?? 'fa-file';
    }

    /**
     * Delete the physical file when model is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($media) {
            if (Storage::exists($media->path)) {
                Storage::delete($media->path);
            }
        });
    }
}
