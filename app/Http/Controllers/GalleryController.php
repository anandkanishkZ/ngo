<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display photo gallery.
     */
    public function photos()
    {
        return view('gallery.photos');
    }

    /**
     * Display video gallery.
     */
    public function videos()
    {
        return view('gallery.videos');
    }
}
