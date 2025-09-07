<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email', 
        'phone',
        'subject',
        'message',
        'inquiry_type',
        'ip_address',
        'status',
        'read_at',
        'admin_notes'
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope for unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Scope for read messages
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    /**
     * Scope for replied messages
     */
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    /**
     * Scope for archived messages
     */
    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    /**
     * Mark message as read
     */
    public function markAsRead()
    {
        $this->update([
            'status' => 'read',
            'read_at' => now()
        ]);
    }

    /**
     * Mark message as replied
     */
    public function markAsReplied()
    {
        $this->update([
            'status' => 'replied'
        ]);
    }

    /**
     * Archive message
     */
    public function archive()
    {
        $this->update([
            'status' => 'archived'
        ]);
    }

    /**
     * Get formatted inquiry type
     */
    public function getInquiryTypeFormattedAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->inquiry_type));
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'unread' => 'bg-danger',
            'read' => 'bg-warning',
            'replied' => 'bg-success',
            'archived' => 'bg-secondary',
            default => 'bg-secondary'
        };
    }

    /**
     * Get time ago formatted
     */
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Get short message preview
     */
    public function getMessagePreviewAttribute()
    {
        return strlen($this->message) > 100 
            ? substr($this->message, 0, 100) . '...' 
            : $this->message;
    }
}
