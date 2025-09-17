<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::published()->public();
        
        // Filter by type
        if ($request->filled('type')) {
            $query->byType($request->type);
        }
        
        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }
        
        // Filter by fiscal year
        if ($request->filled('fiscal_year')) {
            $query->byFiscalYear($request->fiscal_year);
        }
        
        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('executive_summary', 'like', "%{$searchTerm}%");
            });
        }
        
        $reports = $query->orderBy('sort_order')
                        ->orderBy('report_date', 'desc')
                        ->paginate(12);
        
        // Get filter options
        $types = Report::published()->public()->distinct()->pluck('type')->filter()->sort();
        $categories = Report::published()->public()->distinct()->pluck('category')->filter()->sort();
        $fiscalYears = Report::published()->public()->distinct()->pluck('fiscal_year')->filter()->sort();
        $featuredReports = Report::getFeaturedReports(3);
        
        return view('reports.index', compact(
            'reports', 
            'types', 
            'categories', 
            'fiscalYears', 
            'featuredReports'
        ));
    }
    
    public function show(Report $report)
    {
        // Check if report is accessible
        if ($report->status !== 'published' || !$report->is_public) {
            abort(404);
        }
        
        // Get related reports
        $relatedReports = Report::published()
                               ->public()
                               ->where('id', '!=', $report->id)
                               ->where(function($q) use ($report) {
                                   $q->where('type', $report->type)
                                     ->orWhere('category', $report->category);
                               })
                               ->orderBy('report_date', 'desc')
                               ->limit(3)
                               ->get();
        
        return view('reports.show', compact('report', 'relatedReports'));
    }
    
    public function download(Report $report)
    {
        // Check if report is downloadable
        if (!$report->isDownloadable()) {
            abort(404);
        }
        
        // Increment download count
        $report->incrementDownloadCount();
        
        $filePath = storage_path('app/public/reports/pdfs/' . $report->pdf_file);
        
        if (!file_exists($filePath)) {
            abort(404);
        }
        
        $fileName = $report->title . '.pdf';
        
        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/pdf',
        ]);
    }
    
    public function byType(string $type)
    {
        $reports = Report::getReportsByType($type);
        $typeTitle = ucfirst($type) . ' Reports';
        
        return view('reports.by-type', compact('reports', 'type', 'typeTitle'));
    }
}
