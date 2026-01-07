<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImpactStoryController extends Controller
{
    /**
     * Display a listing of impact stories.
     */
    public function index()
    {
        return view('impact-stories.index');
    }

    /**
     * Display the specified impact story.
     */
    public function show($id)
    {
        return view('impact-stories.show', compact('id'));
    }
}
