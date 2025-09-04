<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'original_name',
        'file_name', 
        'file_path',
        'file_size',
        'mime_type',
        'file_type',
        'url',
        'context',
        'context_id',
        'is_used',
        'uploaded_at'
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
        'is_used' => 'boolean',
        'file_size' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($attachment) {
            if (empty($attachment->id)) {
                $attachment->id = Str::uuid();
            }
        });

        static::deleting(function ($attachment) {
            // Delete file from storage when model is deleted
            if (Storage::disk('public')->exists($attachment->file_path)) {
                Storage::disk('public')->delete($attachment->file_path);
            }
        });
    }

    /**
     * Get the file type based on mime type
     */
    public static function getFileType($mimeType): string
    {
        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        }
        
        if ($mimeType === 'application/pdf') {
            return 'pdf';
        }
        
        if (in_array($mimeType, [
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ])) {
            return 'document';
        }
        
        return 'file';
    }

    /**
     * Get formatted file size
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->file_size;
        
        if ($bytes === 0) {
            return '0 Bytes';
        }
        
        $k = 1024;
        $sizes = ['Bytes', 'KB', 'MB', 'GB'];
        $i = floor(log($bytes) / log($k));
        
        return round($bytes / pow($k, $i), 2) . ' ' . $sizes[$i];
    }

    /**
     * Get icon class for file type
     */
    public function getIconClassAttribute(): string
    {
        return match($this->file_type) {
            'image' => 'fas fa-image',
            'pdf' => 'fas fa-file-pdf', 
            'document' => 'fas fa-file-alt',
            default => 'fas fa-file'
        };
    }

    /**
     * Mark attachment as used
     */
    public function markAsUsed($context = null, $contextId = null): void
    {
        $this->update([
            'is_used' => true,
            'context' => $context ?? $this->context,
            'context_id' => $contextId ?? $this->context_id
        ]);
    }

    /**
     * Get unused attachments older than specified hours
     */
    public static function getUnusedOlderThan(int $hours = 24)
    {
        return static::where('is_used', false)
            ->where('uploaded_at', '<', now()->subHours($hours))
            ->get();
    }

    /**
     * Clean up unused old attachments
     */
    public static function cleanupUnused(int $hours = 24): int
    {
        $attachments = static::getUnusedOlderThan($hours);
        $count = $attachments->count();
        
        foreach ($attachments as $attachment) {
            $attachment->delete();
        }
        
        return $count;
    }
}
