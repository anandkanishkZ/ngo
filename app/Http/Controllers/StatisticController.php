<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;
use Illuminate\Support\Facades\Cache;

class StatisticController extends Controller
{
    /**
     * Display a listing of the statistics.
     */
    public function index()
    {
        $statistics = Statistic::orderBy('sort_order')->orderBy('id')->get();
        return view('dashboard.statistics.index', compact('statistics'));
    }

    /**
     * Show the form for creating a new statistic.
     */
    public function create()
    {
        return view('dashboard.statistics.create');
    }

    /**
     * Store a newly created statistic in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:50|unique:statistics,key',
            'label' => 'required|string|max:100',
            'value' => 'required|integer|min:0',
            'icon' => 'nullable|string|max:50',
            'color' => 'required|string|max:20',
            'sort_order' => 'required|integer|min:0',
            'description' => 'nullable|string|max:500'
        ]);

        // Handle checkbox properly - if not sent, it means false
        $validated['is_active'] = $request->has('is_active') ? true : false;
        
        Statistic::create($validated);

        // Clear cache after create
        \Cache::forget('statistics_active');

        return redirect()->route('dashboard.statistics.index')
                        ->with('success', 'Statistic created successfully!');
    }

    /**
     * Display the specified statistic.
     */
    public function show(Statistic $statistic)
    {
        return view('dashboard.statistics.show', compact('statistic'));
    }

    /**
     * Show the form for editing the specified statistic.
     */
    public function edit(Statistic $statistic)
    {
        return view('dashboard.statistics.edit', compact('statistic'));
    }

    /**
     * Update the specified statistic in storage.
     */
    public function update(Request $request, Statistic $statistic)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:50|unique:statistics,key,' . $statistic->id,
            'label' => 'required|string|max:100',
            'value' => 'required|integer|min:0',
            'icon' => 'nullable|string|max:50',
            'color' => 'required|string|max:20',
            'sort_order' => 'required|integer|min:0',
            'description' => 'nullable|string|max:500'
        ]);

        // Handle checkbox properly - if not sent, it means false
        $validated['is_active'] = $request->has('is_active') ? true : false;

        $statistic->update($validated);

        // Clear cache after update
        \Cache::forget('statistics_active');

        return redirect()->route('dashboard.statistics.index')
                        ->with('success', 'Statistic updated successfully!');
    }

    /**
     * Remove the specified statistic from storage.
     */
    public function destroy(Statistic $statistic)
    {
        $statistic->delete();
        
        // Clear cache after delete
        \Cache::forget('statistics_active');
        
        return redirect()->route('dashboard.statistics.index')
                        ->with('success', 'Statistic deleted successfully!');
    }

    /**
     * Toggle the active status of a statistic
     */
    public function toggleActive(Statistic $statistic)
    {
        $statistic->update(['is_active' => !$statistic->is_active]);
        
        // Clear cache after toggle
        \Cache::forget('statistics_active');
        
        return response()->json([
            'success' => true,
            'is_active' => $statistic->is_active
        ]);
    }
}
