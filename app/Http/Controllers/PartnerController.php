<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::orderBy('featured', 'desc')
                          ->orderBy('sort_order')
                          ->orderBy('name')
                          ->get();

        return view('dashboard.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);
        
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }
        
        $data['is_active'] = $request->boolean('is_active');
        $data['featured'] = $request->boolean('featured');
        
        Partner::create($data);
        
        return redirect()->route('dashboard.partners.index')
                        ->with('success', 'Partner created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        return view('dashboard.partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return view('dashboard.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $data = $this->validateData($request);
        
        if ($request->hasFile('logo')) {
            // Delete old logo if it exists and is not a URL
            if ($partner->logo && !filter_var($partner->logo, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partner->logo);
            }
            
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }
        
        $data['is_active'] = $request->boolean('is_active');
        $data['featured'] = $request->boolean('featured');
        
        $partner->update($data);
        
        return redirect()->route('dashboard.partners.index')
                        ->with('success', 'Partner updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        // Delete logo if it exists and is not a URL
        if ($partner->logo && !filter_var($partner->logo, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($partner->logo)) {
            Storage::disk('public')->delete($partner->logo);
        }
        
        $partner->delete();
        
        return redirect()->route('dashboard.partners.index')
                        ->with('success', 'Partner deleted successfully!');
    }

    /**
     * Toggle active status of a partner
     */
    public function toggleActive(Partner $partner)
    {
        $partner->update(['is_active' => !$partner->is_active]);
        
        $status = $partner->is_active ? 'activated' : 'deactivated';
        
        return response()->json([
            'success' => true,
            'message' => "Partner {$status} successfully!",
            'is_active' => $partner->is_active
        ]);
    }

    /**
     * Toggle featured status of a partner
     */
    public function toggleFeatured(Partner $partner)
    {
        $partner->update(['featured' => !$partner->featured]);
        
        $status = $partner->featured ? 'marked as featured' : 'removed from featured';
        
        return response()->json([
            'success' => true,
            'message' => "Partner {$status} successfully!",
            'featured' => $partner->featured
        ]);
    }

    /**
     * Validate partner data
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'website_url' => 'nullable|url|max:500',
            'type' => 'required|in:sponsor,partner,collaborator',
            'sort_order' => 'nullable|integer|min:0',
            'background_color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);
    }
}
