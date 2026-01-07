<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MediaControllerNew extends Controller
{
    /**
     * Display media library
     */
    public function index(Request $request)
    {
        $query = Media::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('filename', 'like', "%{$search}%")
                  ->orWhere('alt_text', 'like', "%{$search}%");
            });
        }

        // Filter by folder
        if ($request->filled('folder')) {
            $query->where('folder', $request->get('folder'));
        }

        // Filter by type
        if ($request->filled('type')) {
            $type = $request->get('type');
            if ($type === 'images') {
                $query->where('is_image', true);
            } elseif ($type === 'documents') {
                $query->where('is_image', false);
            }
        }

        // Ordering
        $orderBy = $request->get('orderby', 'latest');
        switch ($orderBy) {
            case 'oldest':
                $query->oldest();
                break;
            case 'alphabetical':
                $query->orderBy('title');
                break;
            case 'size_desc':
                $query->orderByDesc('size');
                break;
            case 'size_asc':
                $query->orderBy('size');
                break;
            default:
                $query->latest();
        }

        $media = $query->paginate(24);
        $allFolders = Media::distinct()->whereNotNull('folder')->pluck('folder')->toArray();

        return view('dashboard.media.index_new', compact('media', 'allFolders'));
    }

    /**
     * Store new media files
     */
    public function store(Request $request)
    {
        Log::info('Media upload request received');
        Log::info('Request method: ' . $request->method());
        Log::info('Request has files: ' . ($request->hasFile('files') ? 'yes' : 'no'));
        Log::info('Request files count: ' . ($request->file('files') ? count($request->file('files')) : 0));
        Log::info('Request all: ', $request->all());
        Log::info('Request files: ', $request->file() ?: []);
        
        try {
            $request->validate([
                'files' => 'required|array',
                'files.*' => 'required|file|max:10240', // 10MB max
                'folder' => 'nullable|string|max:255'
            ]);

            Log::info('Validation passed');

            $folder = $request->get('folder');
            // Normalize folder to null if empty
            if (empty($folder)) {
                $folder = null;
            }
            $uploadedFiles = [];
            $errors = [];

            foreach ($request->file('files') as $file) {
                try {
                    Log::info('Processing file: ' . $file->getClientOriginalName());
                    
                    // Generate unique filename
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);
                    $filename = Str::slug($nameWithoutExt) . '_' . time() . '.' . $extension;
                    
                    Log::info('Generated filename: ' . $filename);
                    
                    // Get file info BEFORE moving (temp file will be gone after move)
                    $mimeType = $file->getMimeType();
                    $fileSize = $file->getSize();
                    $isImage = str_starts_with($mimeType, 'image/');
                    
                    Log::info('File info - Size: ' . $fileSize . ', MIME: ' . $mimeType . ', IsImage: ' . ($isImage ? 'yes' : 'no'));
                    
                    // Determine upload directory (like hero slides)
                    $uploadDir = $folder ? "uploads/media/{$folder}" : "uploads/media";
                    
                    // Create directory if it doesn't exist
                    if (!file_exists(public_path($uploadDir))) {
                        mkdir(public_path($uploadDir), 0755, true);
                    }
                    
                    Log::info('Upload directory: ' . $uploadDir);
                    
                    // Store file directly in public folder
                    $file->move(public_path($uploadDir), $filename);
                    
                    // File path for URL (relative to public)
                    $filePath = $uploadDir . '/' . $filename;
                    
                    Log::info('File stored at: ' . $filePath);
                    
                    // Get image dimensions if it's an image
                    $width = null;
                    $height = null;
                    if ($isImage && function_exists('getimagesize')) {
                        $fullPath = public_path($filePath);
                        $imageInfo = getimagesize($fullPath);
                        if ($imageInfo) {
                            $width = $imageInfo[0];
                            $height = $imageInfo[1];
                            Log::info('Image dimensions: ' . $width . 'x' . $height);
                        }
                    }

                    // Create database record
                    $media = Media::create([
                        'title' => $nameWithoutExt,
                        'filename' => $filename,
                        'original_filename' => $originalName,
                        'path' => $filePath,
                        'folder' => $folder,
                        'file_size' => $fileSize,
                        'mime_type' => $mimeType,
                        'is_image' => $isImage,
                        'width' => $width,
                        'height' => $height,
                        'uploaded_by' => auth()->id(),
                    ]);

                    Log::info('Database record created for media ID: ' . $media->id);
                    $uploadedFiles[] = $media;
                    
                } catch (\Exception $e) {
                    Log::error('Media upload error for file ' . $originalName . ': ' . $e->getMessage());
                    Log::error('Stack trace: ' . $e->getTraceAsString());
                    $errors[] = "Failed to upload {$originalName}: " . $e->getMessage();
                }
            }

            $totalUploaded = count($uploadedFiles);
            $totalErrors = count($errors);

            Log::info('Upload summary - Total uploaded: ' . $totalUploaded . ', Total errors: ' . $totalErrors);

            if ($totalUploaded > 0) {
                $message = "Successfully uploaded {$totalUploaded} file(s)";
                if ($totalErrors > 0) {
                    $message .= " ({$totalErrors} failed)";
                }
                Log::info('Returning success response: ' . $message);
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'uploaded' => $uploadedFiles,
                    'errors' => $errors
                ]);
            } else {
                Log::warning('No files uploaded successfully');
                return response()->json([
                    'success' => false,
                    'message' => 'No files were uploaded successfully',
                    'errors' => $errors
                ], 422);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Media upload error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show single media item (for editing)
     */
    public function show(Media $media)
    {
        return response()->json($media);
    }

    /**
     * Update media item
     */
    public function update(Request $request, Media $media)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'alt_text' => 'nullable|string|max:255',
                'folder' => 'nullable|string|max:255'
            ]);

            $oldFolder = $media->folder;
            $newFolder = $request->get('folder');

            // Update database
            $media->update([
                'title' => $request->get('title'),
                'alt_text' => $request->get('alt_text'),
                'folder' => $newFolder
            ]);

            // Move file if folder changed
            if ($oldFolder !== $newFolder) {
                $oldPath = $media->path;
                $newPath = ($newFolder ? "media/{$newFolder}/" : "media/") . $media->filename;
                
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->move($oldPath, $newPath);
                    $media->update(['path' => $newPath]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Media updated successfully',
                'media' => $media
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Media update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Update failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete single media item
     */
    public function destroy(Media $media)
    {
        try {
            // Delete file from storage
            if (Storage::disk('public')->exists($media->path)) {
                Storage::disk('public')->delete($media->path);
            }

            // Delete database record
            $media->delete();

            return response()->json([
                'success' => true,
                'message' => 'Media deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Media delete error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Delete failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete media items
     */
    public function bulkDelete(Request $request)
    {
        try {
            $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'required|integer|exists:media,id'
            ]);

            $ids = $request->get('ids');
            $media = Media::whereIn('id', $ids)->get();
            
            $deleted = 0;
            $errors = [];

            foreach ($media as $item) {
                try {
                    // Delete file from storage
                    if (Storage::disk('public')->exists($item->path)) {
                        Storage::disk('public')->delete($item->path);
                    }
                    
                    // Delete database record
                    $item->delete();
                    $deleted++;
                    
                } catch (\Exception $e) {
                    Log::error("Failed to delete media {$item->id}: " . $e->getMessage());
                    $errors[] = "Failed to delete {$item->title}";
                }
            }

            $message = "Successfully deleted {$deleted} file(s)";
            if (count($errors) > 0) {
                $message .= " (" . count($errors) . " failed)";
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'deleted' => $deleted,
                'errors' => $errors
            ]);

        } catch (\Exception $e) {
            Log::error('Bulk delete error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Bulk delete failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Sync files from storage
     */
    public function sync()
    {
        try {
            $files = Storage::disk('public')->allFiles('media');
            $synced = 0;
            $errors = [];

            foreach ($files as $filePath) {
                try {
                    // Skip if already exists in database
                    if (Media::where('path', $filePath)->exists()) {
                        continue;
                    }

                    $fullPath = storage_path('app/public/' . $filePath);
                    
                    // Skip if file doesn't actually exist
                    if (!file_exists($fullPath)) {
                        continue;
                    }

                    $filename = basename($filePath);
                    $folder = dirname($filePath) === 'media' ? null : str_replace('media/', '', dirname($filePath));
                    
                    // Get file info
                    $fileSize = filesize($fullPath);
                    $mimeType = mime_content_type($fullPath);
                    $isImage = str_starts_with($mimeType, 'image/');
                    
                    // Get image dimensions if it's an image
                    $width = null;
                    $height = null;
                    if ($isImage && function_exists('getimagesize')) {
                        $imageInfo = getimagesize($fullPath);
                        if ($imageInfo) {
                            $width = $imageInfo[0];
                            $height = $imageInfo[1];
                        }
                    }

                    // Create database record
                    Media::create([
                        'title' => pathinfo($filename, PATHINFO_FILENAME),
                        'filename' => $filename,
                        'original_filename' => $filename,
                        'path' => $filePath,
                        'folder' => $folder,
                        'file_size' => $fileSize,
                        'mime_type' => $mimeType,
                        'is_image' => $isImage,
                        'width' => $width,
                        'height' => $height,
                        'uploaded_by' => auth()->id(),
                    ]);

                    $synced++;
                    
                } catch (\Exception $e) {
                    Log::error("Failed to sync file {$filePath}: " . $e->getMessage());
                    $errors[] = "Failed to sync " . basename($filePath);
                }
            }

            $message = "Successfully synced {$synced} file(s)";
            if (count($errors) > 0) {
                $message .= " (" . count($errors) . " failed)";
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'synced' => $synced,
                'errors' => $errors
            ]);

        } catch (\Exception $e) {
            Log::error('Sync error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Sync failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create new folder
     */
    public function createFolder(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|regex:/^[a-z0-9\-_]+$/i'
            ]);

            $folderName = Str::slug($request->get('name'));
            $folderPath = "media/{$folderName}";

            // Create folder in storage
            if (!Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->makeDirectory($folderPath);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Folder created successfully',
                    'folder' => $folderName
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Folder already exists'
                ], 422);
            }

        } catch (\Exception $e) {
            Log::error('Create folder error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create folder: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API endpoint for media picker component
     */
    public function picker(Request $request)
    {
        $query = Media::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('filename', 'like', "%{$search}%")
                  ->orWhere('alt_text', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('type') && $request->get('type') === 'image') {
            $query->where('is_image', true);
        }

        // Filter by folder
        if ($request->filled('folder')) {
            $query->where('folder', $request->get('folder'));
        }

        $media = $query->latest()->paginate(24);

        return view('dashboard.media.picker', compact('media'));
    }
}
