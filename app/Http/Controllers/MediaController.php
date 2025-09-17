<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the media library
     */
    public function index(Request $request)
    {
        // Sync files on first load or if explicitly requested
        if ($request->get('sync') === '1' || $request->get('auto_sync') !== '0') {
            $this->syncStorageFiles();
        }

        $query = Media::latestFirst(); // Use scope for better ordering

        // Apply ordering based on request
        $orderBy = $request->get('orderby', 'latest');
        switch ($orderBy) {
            case 'oldest':
                $query = Media::oldestFirst();
                break;
            case 'alphabetical':
                $query = Media::alphabetical();
                break;
            case 'size_desc':
                $query = Media::bySize('desc');
                break;
            case 'size_asc':
                $query = Media::bySize('asc');
                break;
            case 'latest':
            default:
                $query = Media::latestFirst();
                break;
        }

        // Filter by search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by folder
        if ($request->filled('folder')) {
            $query->inFolder($request->folder);
        }

        // Filter by type
        if ($request->filled('type')) {
            if ($request->type === 'images') {
                $query->images();
            } elseif ($request->type === 'documents') {
                $query->where('is_image', false);
            }
        }

        $media = $query->paginate(24);

        // Get available folders
        $folders = Media::distinct()->pluck('folder')->filter()->sort()->values();

        // Get storage folders from file system
        $storageFolders = $this->getStorageFolders();
        $allFolders = $folders->merge($storageFolders)->unique()->sort()->values();

        return view('dashboard.media.index', compact('media', 'allFolders'));
    }

    /**
     * Sync storage files with database
     */
    public function syncStorageFiles()
    {
        $storagePath = storage_path('app/public');
        $syncedCount = 0;
        $errors = [];

        try {
            $this->scanDirectory($storagePath, '', $syncedCount, $errors);
            
            // Clean up orphaned database records
            $this->cleanupOrphanedRecords();
            
            return response()->json([
                'success' => true,
                'synced' => $syncedCount,
                'errors' => $errors,
                'message' => "Synced {$syncedCount} files successfully."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sync failed: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Recursively scan directory and sync files
     */
    private function scanDirectory($fullPath, $relativePath = '', &$syncedCount = 0, &$errors = [])
    {
        if (!is_dir($fullPath)) {
            return;
        }

        $items = scandir($fullPath);
        
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $itemFullPath = $fullPath . DIRECTORY_SEPARATOR . $item;
            $itemRelativePath = $relativePath ? $relativePath . '/' . $item : $item;

            if (is_dir($itemFullPath)) {
                // Recursively scan subdirectories
                $this->scanDirectory($itemFullPath, $itemRelativePath, $syncedCount, $errors);
            } else {
                // Process file
                try {
                    if ($this->syncFile($itemFullPath, $itemRelativePath)) {
                        $syncedCount++;
                    }
                } catch (\Exception $e) {
                    $errors[] = "Error syncing {$itemRelativePath}: " . $e->getMessage();
                }
            }
        }
    }

    /**
     * Sync individual file with database
     */
    private function syncFile($fullPath, $relativePath)
    {
        // Check if file already exists in database
        $existing = Media::where('path', $relativePath)->first();
        
        if ($existing) {
            // Verify file still exists and update if needed
            if (!Storage::disk('public')->exists($relativePath)) {
                $existing->delete();
                return false;
            }
            return false; // Already synced
        }

        // Skip hidden files and temp files
        $filename = basename($relativePath);
        if (str_starts_with($filename, '.') || str_ends_with($filename, '.tmp')) {
            return false;
        }

        // Get file info
        $fileInfo = $this->getFileInfo($fullPath, $relativePath);
        
        if (!$fileInfo) {
            return false;
        }

        // Create media record
        Media::create($fileInfo);
        
        return true;
    }

    /**
     * Get file information for database storage
     */
    private function getFileInfo($fullPath, $relativePath)
    {
        if (!file_exists($fullPath)) {
            return null;
        }

        $filename = basename($relativePath);
        $mimeType = mime_content_type($fullPath);
        $size = filesize($fullPath);
        $isImage = str_starts_with($mimeType, 'image/');
        
        // Extract folder from path
        $folder = dirname($relativePath);
        if ($folder === '.' || $folder === '/') {
            $folder = null;
        }

        // Get image dimensions if it's an image
        $width = null;
        $height = null;
        if ($isImage && function_exists('getimagesize')) {
            try {
                $dimensions = getimagesize($fullPath);
                $width = $dimensions[0] ?? null;
                $height = $dimensions[1] ?? null;
            } catch (\Exception $e) {
                // Ignore dimension errors
            }
        }

        return [
            'title' => pathinfo($filename, PATHINFO_FILENAME),
            'alt_text' => null,
            'filename' => $filename,
            'original_filename' => $filename,
            'mime_type' => $mimeType,
            'file_size' => $size,
            'path' => $relativePath,
            'width' => $width,
            'height' => $height,
            'folder' => $folder,
            'is_image' => $isImage,
            'uploaded_by' => Auth::id(),
            'created_at' => Carbon::createFromTimestamp(filectime($fullPath)),
            'updated_at' => Carbon::createFromTimestamp(filemtime($fullPath)),
        ];
    }

    /**
     * Clean up orphaned database records
     */
    private function cleanupOrphanedRecords()
    {
        $media = Media::all();
        $deletedCount = 0;

        foreach ($media as $item) {
            if (!Storage::disk('public')->exists($item->path)) {
                $item->delete();
                $deletedCount++;
            }
        }

        return $deletedCount;
    }

    /**
     * Get folders from storage directory
     */
    private function getStorageFolders()
    {
        $folders = collect();
        $storagePath = storage_path('app/public');
        
        if (is_dir($storagePath)) {
            $items = File::directories($storagePath);
            foreach ($items as $item) {
                $folderName = basename($item);
                $folders->push($folderName);
                
                // Also scan subdirectories
                $this->scanSubfolders($item, $folderName, $folders);
            }
        }
        
        return $folders;
    }

    /**
     * Recursively scan subfolders
     */
    private function scanSubfolders($path, $currentPath, &$folders)
    {
        $items = File::directories($path);
        foreach ($items as $item) {
            $folderName = $currentPath . '/' . basename($item);
            $folders->push($folderName);
            $this->scanSubfolders($item, $folderName, $folders);
        }
    }

    /**
     * Show media picker modal (for selecting media)
     */
    public function picker(Request $request)
    {
        // Auto-sync if requested
        if ($request->get('sync') === '1') {
            $this->syncStorageFiles();
        }

        $query = Media::latestFirst(); // Use scope for better ordering

        // Filter by type if specified
        if ($request->filled('type')) {
            if ($request->type === 'image') {
                $query->images();
            }
        }

        // Filter by search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by folder
        if ($request->filled('folder')) {
            $query->inFolder($request->folder);
        }

        $media = $query->paginate(12);

        return view('dashboard.media.picker', compact('media'))->render();
    }

    /**
     * Store uploaded media
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'files' => 'required',
                'files.*' => 'file|max:20480|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,txt,csv,mp4,avi,mov,mp3,wav', // 20MB max
                'folder' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9\-_\/\s]*$/'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => array_values($e->errors())[0] ?? ['Validation error']
                ], 422);
            }
            throw $e;
        }

        if (!$request->hasFile('files')) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No files uploaded',
                    'errors' => ['No files were provided']
                ], 400);
            }
            return back()->withErrors(['files' => 'No files uploaded']);
        }

        $uploadedFiles = [];
        $errors = [];

        foreach ($request->file('files') as $file) {
            try {
                $media = $this->processUpload($file, $request->folder);
                $uploadedFiles[] = $media;
            } catch (\Exception $e) {
                \Log::error('Upload error: ' . $e->getMessage(), ['file' => $file->getClientOriginalName(), 'trace' => $e->getTraceAsString()]);
                $errors[] = 'Failed to upload ' . $file->getClientOriginalName() . ': ' . $e->getMessage();
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => count($uploadedFiles) > 0,
                'files' => $uploadedFiles,
                'errors' => $errors,
                'message' => count($uploadedFiles) . ' file(s) uploaded successfully.' . 
                           (count($errors) > 0 ? ' ' . count($errors) . ' failed.' : '')
            ]);
        }

        $message = count($uploadedFiles) . ' file(s) uploaded successfully.';
        if (count($errors) > 0) {
            $message .= ' ' . count($errors) . ' failed.';
        }

        return back()->with('success', $message);
    }

    /**
     * Process single file upload with enhanced validation and error handling
     */
    private function processUpload($file, $folder = null)
    {
        if (!$file->isValid()) {
            throw new \Exception('Invalid file upload');
        }

        $originalName = $file->getClientOriginalName();
        $extension = strtolower($file->getClientOriginalExtension());
        $mimeType = $file->getMimeType();
        $size = $file->getSize();

        // Validate file type
        $allowedTypes = [
            'image/jpeg', 'image/png', 'image/gif', 'image/webp',
            'application/pdf',
            'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'application/zip', 'application/x-rar-compressed',
            'text/plain', 'text/csv',
            'video/mp4', 'video/avi', 'video/quicktime',
            'audio/mpeg', 'audio/wav'
        ];

        if (!in_array($mimeType, $allowedTypes)) {
            throw new \Exception('File type not allowed: ' . $mimeType);
        }

        // Sanitize folder name
        if ($folder) {
            $folder = preg_replace('/[^a-zA-Z0-9\-_\/\s]/', '', $folder);
            $folder = trim($folder, '/');
        }

        // Generate unique filename
        $filename = Str::uuid() . '.' . $extension;

        // Determine storage path
        $folderPath = $folder ? "media/{$folder}" : 'media';
        
        // Ensure directory exists
        Storage::disk('public')->makeDirectory($folderPath);
        
        $path = $file->storeAs($folderPath, $filename, 'public');

        if (!$path) {
            throw new \Exception('Failed to store file');
        }

        // Check if file is an image
        $isImage = str_starts_with($mimeType, 'image/');
        $width = null;
        $height = null;

        // Get image dimensions if it's an image
        if ($isImage) {
            try {
                $imagePath = storage_path('app/public/' . $path);
                if (function_exists('getimagesize')) {
                    $dimensions = getimagesize($imagePath);
                    $width = $dimensions[0] ?? null;
                    $height = $dimensions[1] ?? null;
                }
            } catch (\Exception $e) {
                // Ignore if can't get dimensions
            }
        }

        // Create media record
        $media = Media::create([
            'title' => pathinfo($originalName, PATHINFO_FILENAME),
            'filename' => $filename,
            'original_filename' => $originalName,
            'mime_type' => $mimeType,
            'file_size' => $size,
            'path' => $path,
            'width' => $width,
            'height' => $height,
            'folder' => $folder,
            'is_image' => $isImage,
            'uploaded_by' => Auth::id()
        ]);

        return $media;
    }

    /**
     * Show single media item
     */
    public function show(Media $media)
    {
        // Verify file exists
        if (!Storage::disk('public')->exists($media->path)) {
            $media->update(['path' => 'MISSING_FILE']);
        }

        return response()->json($media);
    }

    /**
     * Update media details
     */
    public function update(Request $request, Media $media)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'folder' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9\-_\/\s]*$/'
        ]);

        // If folder is being changed, move the file
        if ($request->folder !== $media->folder && Storage::disk('public')->exists($media->path)) {
            $oldPath = $media->path;
            $newFolder = $request->folder ? "media/{$request->folder}" : 'media';
            $newPath = $newFolder . '/' . $media->filename;

            try {
                Storage::disk('public')->makeDirectory($newFolder);
                Storage::disk('public')->move($oldPath, $newPath);
                $media->path = $newPath;
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to move file: ' . $e->getMessage()
                ]);
            }
        }

        $media->update([
            'title' => $request->title,
            'alt_text' => $request->alt_text,
            'folder' => $request->folder
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'media' => $media->fresh(),
                'message' => 'Media updated successfully.'
            ]);
        }

        return back()->with('success', 'Media updated successfully.');
    }

    /**
     * Delete media
     */
    public function destroy(Media $media)
    {
        try {
            // Delete physical file
            if (Storage::disk('public')->exists($media->path)) {
                Storage::disk('public')->delete($media->path);
            }

            // Delete database record
            $media->delete();

            return response()->json([
                'success' => true,
                'message' => 'Media deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete media: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Bulk delete media
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:media,id'
        ]);

        $count = 0;
        $errors = [];

        foreach ($request->ids as $id) {
            try {
                $media = Media::find($id);
                if ($media) {
                    if (Storage::disk('public')->exists($media->path)) {
                        Storage::disk('public')->delete($media->path);
                    }
                    $media->delete();
                    $count++;
                }
            } catch (\Exception $e) {
                $errors[] = "Failed to delete media ID {$id}: " . $e->getMessage();
            }
        }

        return response()->json([
            'success' => $count > 0,
            'message' => "{$count} file(s) deleted successfully." . 
                        (count($errors) > 0 ? ' ' . count($errors) . ' failed.' : ''),
            'errors' => $errors
        ]);
    }

    /**
     * Create new folder
     */
    public function createFolder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z0-9\-_\s]+$/'
        ]);

        $folderName = Str::slug($request->name, '_');
        $folderPath = "media/{$folderName}";

        try {
            Storage::disk('public')->makeDirectory($folderPath);

            return response()->json([
                'success' => true,
                'folder' => $folderName,
                'message' => 'Folder created successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create folder: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get media statistics
     */
    public function stats()
    {
        $stats = [
            'total_files' => Media::count(),
            'total_images' => Media::images()->count(),
            'total_size' => Media::sum('file_size'),
            'recent_uploads' => Media::where('created_at', '>=', now()->subDays(7))->count(),
            'folders' => Media::distinct('folder')->count('folder'),
            'storage_files' => $this->countStorageFiles(),
        ];

        $stats['total_size_formatted'] = $this->formatBytes($stats['total_size']);
        $stats['sync_needed'] = $stats['storage_files'] > $stats['total_files'];

        return response()->json($stats);
    }

    /**
     * Count actual files in storage
     */
    private function countStorageFiles()
    {
        $storagePath = storage_path('app/public');
        $count = 0;
        
        if (is_dir($storagePath)) {
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($storagePath, \RecursiveDirectoryIterator::SKIP_DOTS)
            );
            
            foreach ($iterator as $file) {
                if ($file->isFile() && !str_starts_with($file->getFilename(), '.')) {
                    $count++;
                }
            }
        }
        
        return $count;
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; ($bytes / 1024) > 0.9; $i++, $bytes /= 1024) {}

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
