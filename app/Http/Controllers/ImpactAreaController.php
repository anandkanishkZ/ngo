<?php

namespace App\Http\Controllers;

use App\Models\ImpactArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ImpactAreaController extends Controller
{
    /**
     * Display the public thematic areas page.
     */
    public function publicIndex()
    {
        $impactAreas = ImpactArea::getActiveAreas();
        return view('impact-areas.index', compact('impactAreas'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $impactAreas = ImpactArea::orderBy('sort_order')->get();
        return view('dashboard.impact-areas.index', compact('impactAreas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.impact-areas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'required|string|max:20',
            'sort_order' => 'required|integer|min:0'
        ]);

        // Handle checkbox properly - if not sent, it means false
        $validated['is_active'] = $request->has('is_active') ? true : false;
        
        ImpactArea::create($validated);

        // Clear cache after create
        Cache::forget('impact_areas_active');

        return redirect()->route('dashboard.impact-areas.index')
                        ->with('success', 'Impact Area created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ImpactArea $impactArea)
    {
        return view('dashboard.impact-areas.show', compact('impactArea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImpactArea $impactArea)
    {
        return view('dashboard.impact-areas.edit', compact('impactArea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImpactArea $impactArea)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'required|string|max:20',
            'sort_order' => 'required|integer|min:0'
        ]);

        // Handle checkbox properly - if not sent, it means false
        $validated['is_active'] = $request->has('is_active') ? true : false;

        $impactArea->update($validated);

        // Clear cache after update
        Cache::forget('impact_areas_active');

        return redirect()->route('dashboard.impact-areas.index')
                        ->with('success', 'Impact Area updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImpactArea $impactArea)
    {
        $impactArea->delete();
        
        // Clear cache after delete
        Cache::forget('impact_areas_active');
        
        return redirect()->route('dashboard.impact-areas.index')
                        ->with('success', 'Impact Area deleted successfully!');
    }

    /**
     * Toggle the active status of an impact area
     */
    public function toggleActive(ImpactArea $impactArea)
    {
        $impactArea->update(['is_active' => !$impactArea->is_active]);
        
        // Clear cache after toggle
        Cache::forget('impact_areas_active');
        
        return response()->json([
            'success' => true,
            'is_active' => $impactArea->is_active
        ]);
    }
}
