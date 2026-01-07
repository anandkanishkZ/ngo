<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Report::query();
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', 'like', "%{$request->category}%");
        }
        
        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('author', 'like', "%{$searchTerm}%");
            });
        }
        
        // Apply sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'downloads':
                $query->orderBy('download_count', 'desc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        $reports = $query->paginate(15);
        
        // Calculate statistics
        $stats = [
            'total' => Report::count(),
            'published' => Report::where('status', 'published')->count(),
            'draft' => Report::where('status', 'draft')->count(),
            'total_downloads' => Report::sum('download_count')
        ];
        
        return view('dashboard.reports.index', compact('reports', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'executive_summary' => 'nullable|string',
            'content' => 'nullable|string',
            'type' => 'required|in:annual,financial,impact,project,research,governance',
            'category' => 'nullable|string|max:100',
            'fiscal_year' => 'nullable|string|max:10',
            'report_date' => 'required|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'author' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'key_findings' => 'nullable|string',
            'recommendations' => 'nullable|string',
        ]);

        // Handle status from checkbox
        $validated['status'] = $request->has('is_published') ? 'published' : 'draft';
        $validated['is_public'] = true;
        $validated['sort_order'] = 0;

        // Handle file uploads
        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $coverImageName = time() . '_' . Str::random(10) . '.' . $coverImage->getClientOriginalExtension();
            $coverImage->move(public_path('uploads/reports'), $coverImageName);
            $validated['cover_image'] = $coverImageName;
        }

        if ($request->hasFile('pdf_file')) {
            $pdfFile = $request->file('pdf_file');
            $pdfFileName = time() . '_' . Str::random(10) . '.pdf';
            $pdfFile->move(public_path('uploads/reports'), $pdfFileName);
            $validated['pdf_file'] = $pdfFileName;
        }

        // Set published_at if status is published
        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $validated['author'] = $validated['author'] ?? 'JIDS Nepal';

        $report = Report::create($validated);

        return redirect()->route('dashboard.reports.index')
                        ->with('success', 'Report created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        return view('dashboard.reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        return view('dashboard.reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'executive_summary' => 'nullable|string',
            'content' => 'nullable|string',
            'type' => 'required|in:annual,financial,impact,project,research,governance',
            'category' => 'nullable|string|max:100',
            'fiscal_year' => 'nullable|string|max:10',
            'report_date' => 'required|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'author' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'key_findings' => 'nullable|string',
            'recommendations' => 'nullable|string',
        ]);

        // Handle status from checkbox
        $validated['status'] = $request->has('is_published') ? 'published' : 'draft';

        // Handle file removal
        if ($request->filled('remove_cover_image') && $request->remove_cover_image == '1') {
            if ($report->cover_image && file_exists(public_path('uploads/reports/' . $report->cover_image))) {
                unlink(public_path('uploads/reports/' . $report->cover_image));
                $validated['cover_image'] = null;
            }
        }

        if ($request->filled('remove_pdf_file') && $request->remove_pdf_file == '1') {
            if ($report->pdf_file && file_exists(public_path('uploads/reports/' . $report->pdf_file))) {
                unlink(public_path('uploads/reports/' . $report->pdf_file));
                $validated['pdf_file'] = null;
            }
        }

        // Handle file uploads
        if ($request->hasFile('cover_image')) {
            // Delete old cover image
            if ($report->cover_image && file_exists(public_path('uploads/reports/' . $report->cover_image))) {
                unlink(public_path('uploads/reports/' . $report->cover_image));
            }
            
            $coverImage = $request->file('cover_image');
            $coverImageName = time() . '_' . Str::random(10) . '.' . $coverImage->getClientOriginalExtension();
            $coverImage->move(public_path('uploads/reports'), $coverImageName);
            $validated['cover_image'] = $coverImageName;
        }

        if ($request->hasFile('pdf_file')) {
            // Delete old PDF file
            if ($report->pdf_file && file_exists(public_path('uploads/reports/' . $report->pdf_file))) {
                unlink(public_path('uploads/reports/' . $report->pdf_file));
            }
            
            $pdfFile = $request->file('pdf_file');
            $pdfFileName = time() . '_' . Str::random(10) . '.pdf';
            $pdfFile->move(public_path('uploads/reports'), $pdfFileName);
            $validated['pdf_file'] = $pdfFileName;
        }

        // Set published_at if status is changed to published
        if ($validated['status'] === 'published' && $report->status !== 'published') {
            $validated['published_at'] = now();
        } elseif ($validated['status'] !== 'published') {
            $validated['published_at'] = null;
        }

        $validated['author'] = $validated['author'] ?? 'JIDS Nepal';

        $report->update($validated);

        return redirect()->route('dashboard.reports.index')
                        ->with('success', 'Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        // Delete associated files
        if ($report->cover_image && file_exists(public_path('uploads/reports/' . $report->cover_image))) {
            unlink(public_path('uploads/reports/' . $report->cover_image));
        }
        
        if ($report->pdf_file && file_exists(public_path('uploads/reports/' . $report->pdf_file))) {
            unlink(public_path('uploads/reports/' . $report->pdf_file));
        }

        $report->delete();

        return redirect()->route('dashboard.reports.index')
                        ->with('success', 'Report deleted successfully.');
    }

    /**
     * Toggle report status
     */
    public function toggleStatus(Report $report)
    {
        $newStatus = $report->status === 'published' ? 'draft' : 'published';
        
        $updateData = ['status' => $newStatus];
        
        if ($newStatus === 'published' && !$report->published_at) {
            $updateData['published_at'] = now();
        } elseif ($newStatus !== 'published') {
            $updateData['published_at'] = null;
        }
        
        $report->update($updateData);

        $message = $newStatus === 'published' ? 'Report published successfully.' : 'Report unpublished successfully.';
        
        return redirect()->back()->with('success', $message);
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Report $report)
    {
        $report->update(['is_featured' => !$report->is_featured]);
        
        $message = $report->is_featured ? 'Report marked as featured.' : 'Report removed from featured.';
        
        return redirect()->back()->with('success', $message);
    }
}
