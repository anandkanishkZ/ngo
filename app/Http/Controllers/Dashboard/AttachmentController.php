<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttachmentController extends Controller
{
    /**
     * Upload a file attachment
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:5120|mimes:jpeg,png,jpg,gif,webp,pdf,doc,docx'
        ]);

        try {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mimeType = $file->getMimeType();
            
            // Generate unique filename
            $fileName = Str::random(40) . '.' . $extension;
            
            // Store file in attachments directory
            $path = $file->storeAs('attachments', $fileName, 'public');
            
            // Create attachment record in database
            $attachment = Attachment::create([
                'original_name' => $originalName,
                'file_name' => $fileName,
                'file_path' => $path,
                'file_size' => $size,
                'mime_type' => $mimeType,
                'file_type' => Attachment::getFileType($mimeType),
                'url' => Storage::url($path),
                'context' => 'content',
                'uploaded_at' => now()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully',
                'file' => [
                    'id' => $attachment->id,
                    'original_name' => $attachment->original_name,
                    'url' => $attachment->url,
                    'file_size' => $attachment->file_size,
                    'file_type' => $attachment->file_type,
                    'formatted_size' => $attachment->formatted_size
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Remove an uploaded attachment
     */
    public function remove($fileId)
    {
        try {
            $attachment = Attachment::find($fileId);
            
            if (!$attachment) {
                return response()->json([
                    'success' => false,
                    'message' => 'File not found'
                ], 404);
            }
            
            // Delete the attachment (model will handle file deletion)
            $attachment->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'File removed successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Remove failed: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get list of uploaded attachments
     */
    public function list()
    {
        try {
            $attachments = Attachment::where('is_used', false)
                ->orderBy('uploaded_at', 'desc')
                ->get()
                ->map(function ($attachment) {
                    return [
                        'id' => $attachment->id,
                        'original_name' => $attachment->original_name,
                        'url' => $attachment->url,
                        'file_size' => $attachment->file_size,
                        'file_type' => $attachment->file_type,
                        'formatted_size' => $attachment->formatted_size,
                        'icon_class' => $attachment->icon_class
                    ];
                });
            
            return response()->json([
                'success' => true,
                'files' => $attachments
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load files: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Clean up old attachments (can be called by a scheduled job)
     */
    public function cleanup()
    {
        try {
            $count = Attachment::cleanupUnused(24); // Clean files older than 24 hours
            
            return response()->json([
                'success' => true,
                'message' => "Cleanup completed. Removed {$count} unused files."
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cleanup failed: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Mark attachment as used when content is saved
     */
    public function markAsUsed(Request $request)
    {
        try {
            $request->validate([
                'attachment_ids' => 'required|array',
                'context' => 'required|string',
                'context_id' => 'nullable|string'
            ]);
            
            $attachmentIds = $request->input('attachment_ids');
            $context = $request->input('context');
            $contextId = $request->input('context_id');
            
            Attachment::whereIn('id', $attachmentIds)
                ->update([
                    'is_used' => true,
                    'context' => $context,
                    'context_id' => $contextId
                ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Attachments marked as used'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to mark attachments: ' . $e->getMessage()
            ], 500);
        }
    }
}
