<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\GalleryPhoto;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryPhotoController extends Controller
{
    /**
     * Display a listing of gallery photos
     */
    public function index(Request $request)
    {
        $query = GalleryPhoto::with('media');

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by category
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->status === 'featured') {
                $query->where('is_featured', true);
            }
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'display_order');
        $sortOrder = $request->get('sort_order', 'asc');
        
        if ($sortBy === 'display_order') {
            $query->orderBy('display_order', $sortOrder)->orderBy('created_at', 'desc');
        } elseif ($sortBy === 'recent') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sortBy === 'views') {
            $query->orderBy('views_count', 'desc');
        } elseif ($sortBy === 'photo_date') {
            $query->orderBy('photo_date', $sortOrder);
        }

        $photos = $query->paginate(20);
        $categories = GalleryPhoto::getCategoryOptions();

        return view('dashboard.gallery.index', compact('photos', 'categories'));
    }

    /**
     * Show the form for creating a new gallery photo
     */
    public function create()
    {
        // Get available media (images only)
        $availableMedia = Media::where('is_image', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = GalleryPhoto::getCategoryOptions();

        return view('dashboard.gallery.create', compact('availableMedia', 'categories'));
    }

    /**
     * Store a newly created gallery photo
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'media_id' => 'required|exists:media,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:50',
            'tags' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'photo_date' => 'nullable|date',
            'photographer' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // Set defaults
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        GalleryPhoto::create($validated);

        return redirect()->route('dashboard.gallery.index')
            ->with('success', 'Gallery photo added successfully!');
    }

    /**
     * Display the specified gallery photo
     */
    public function show(GalleryPhoto $galleryPhoto)
    {
        $galleryPhoto->load('media');
        return view('dashboard.gallery.show', compact('galleryPhoto'));
    }

    /**
     * Show the form for editing the specified gallery photo
     */
    public function edit(GalleryPhoto $galleryPhoto)
    {
        $galleryPhoto->load('media');
        
        // Get available media (images only)
        $availableMedia = Media::where('is_image', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = GalleryPhoto::getCategoryOptions();

        return view('dashboard.gallery.edit', compact('galleryPhoto', 'availableMedia', 'categories'));
    }

    /**
     * Update the specified gallery photo
     */
    public function update(Request $request, GalleryPhoto $galleryPhoto)
    {
        $validated = $request->validate([
            'media_id' => 'required|exists:media,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:50',
            'tags' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'photo_date' => 'nullable|date',
            'photographer' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // Set defaults
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        $galleryPhoto->update($validated);

        return redirect()->route('dashboard.gallery.index')
            ->with('success', 'Gallery photo updated successfully!');
    }

    /**
     * Remove the specified gallery photo
     */
    public function destroy(GalleryPhoto $galleryPhoto)
    {
        $galleryPhoto->delete();

        return redirect()->route('dashboard.gallery.index')
            ->with('success', 'Gallery photo removed from gallery successfully!');
    }

    /**
     * Toggle active status
     */
    public function toggleStatus(GalleryPhoto $galleryPhoto)
    {
        $galleryPhoto->update(['is_active' => !$galleryPhoto->is_active]);

        return back()->with('success', 'Status updated successfully!');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(GalleryPhoto $galleryPhoto)
    {
        $galleryPhoto->update(['is_featured' => !$galleryPhoto->is_featured]);

        return back()->with('success', 'Featured status updated successfully!');
    }

    /**
     * Bulk update display order
     */
    public function updateOrder(Request $request)
    {
        $orders = $request->validate([
            'orders' => 'required|array',
            'orders.*' => 'integer',
        ]);

        foreach ($orders['orders'] as $id => $order) {
            GalleryPhoto::where('id', $id)->update(['display_order' => $order]);
        }

        return response()->json(['success' => true, 'message' => 'Display order updated successfully!']);
    }
}
