<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('position')->get();
        return view('dashboard.hero_slides.index', compact('slides'));
    }

    public function create()
    {
        return view('dashboard.hero_slides.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('bg_image')) {
            $data['bg_image'] = $request->file('bg_image')->store('hero', 'public');
        }
        $data['is_active'] = $request->boolean('is_active');
        HeroSlide::create($data);
        return redirect()->route('dashboard.hero.index')->with('status', 'Slide created');
    }

    public function edit(HeroSlide $slide)
    {
        return view('dashboard.hero_slides.edit', compact('slide'));
    }

    public function update(Request $request, HeroSlide $slide)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('bg_image')) {
            // remove previous file if exists
            if ($slide->bg_image && Storage::disk('public')->exists($slide->bg_image)) {
                Storage::disk('public')->delete($slide->bg_image);
            }
            $data['bg_image'] = $request->file('bg_image')->store('hero', 'public');
        }
        $data['is_active'] = $request->boolean('is_active');
        $slide->update($data);
        return redirect()->route('dashboard.hero.index')->with('status', 'Slide updated');
    }

    public function destroy(HeroSlide $slide)
    {
        if ($slide->bg_image && Storage::disk('public')->exists($slide->bg_image)) {
            Storage::disk('public')->delete($slide->bg_image);
        }
        $slide->delete();
        return back()->with('status', 'Slide deleted');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'title_url' => 'nullable|url|max:500',
            'subtitle' => 'nullable|string',
            'title_color' => 'required|string|max:20',
            'subtitle_color' => 'required|string|max:20',
            'title_size' => 'required|string|max:20',
            'subtitle_size' => 'required|string|max:20',
            'button1_text' => 'nullable|string|max:255',
            'button1_url' => 'nullable|url',
            'button1_style' => 'nullable|string|max:50',
            'button2_text' => 'nullable|string|max:255',
            'button2_url' => 'nullable|url',
            'button2_style' => 'nullable|string|max:50',
            'bg_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:4096',
            'text_position' => 'nullable|string|in:left,center,right',
            'vertical_position' => 'nullable|string|in:top,middle,bottom',
            'animation' => 'nullable|string|max:50',
            'animation_duration' => 'nullable|string|max:10',
            'overlay_enabled' => 'sometimes|boolean', // Changed from 'nullable|boolean' to 'sometimes|boolean'
            'position' => 'nullable|integer|min:1|max:100',
            'is_active' => 'sometimes|boolean', // Changed from 'nullable|boolean' to 'sometimes|boolean'
        ]);
    }
}
