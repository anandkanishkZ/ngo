<?php

namespace App\Http\Controllers;

use App\Models\GalleryPhoto;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display photo gallery.
     */
    public function photos(Request $request)
    {
        $query = GalleryPhoto::where('is_active', true)->with('media');

        // Filter by category
        if ($request->filled('category') && $request->category !== 'all') {
            $query->byCategory($request->category);
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Sorting
        $sortBy = $request->get('sort', 'default');
        
        if ($sortBy === 'recent') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sortBy === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sortBy === 'popular') {
            $query->orderBy('views_count', 'desc');
        } else {
            // Default: display order, then most recent
            $query->orderBy('display_order', 'asc')->orderBy('created_at', 'desc');
        }

        $photos = $query->paginate(12);
        $featuredPhotos = GalleryPhoto::getFeaturedPhotos(6);
        $categories = GalleryPhoto::getCategoryOptions();
        
        // Get photo count by category
        $categoryCounts = GalleryPhoto::where('is_active', true)
            ->selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category');

        return view('gallery.photos', compact('photos', 'featuredPhotos', 'categories', 'categoryCounts'));
    }

    /**
     * Display video gallery.
     */
    public function videos()
    {
        return view('gallery.videos');
    }

    /**
     * Show single photo detail
     */
    public function show($id)
    {
        $photo = GalleryPhoto::where('is_active', true)
            ->with('media')
            ->findOrFail($id);

        // Increment views
        $photo->incrementViews();

        // Get similar photos
        $similarPhotos = $photo->getSimilarPhotos(4);

        return view('gallery.show', compact('photo', 'similarPhotos'));
    }
}
