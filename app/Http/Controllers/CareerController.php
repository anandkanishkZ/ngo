<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;

class CareerController extends Controller
{
    /**
     * Display vacancy listings.
     */
    public function vacancy(Request $request)
    {
        $query = Vacancy::getActiveVacancies();
        
        // Filter by category if provided
        if ($request->has('category') && $request->category) {
            $query = $query->where('category', $request->category);
        }
        
        // Filter by department if provided
        if ($request->has('department') && $request->department) {
            $query = $query->where('department', $request->department);
        }
        
        // Search if provided
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query = $query->filter(function($vacancy) use ($searchTerm) {
                return stripos($vacancy->title, $searchTerm) !== false ||
                       stripos($vacancy->position, $searchTerm) !== false ||
                       stripos($vacancy->description, $searchTerm) !== false;
            });
        }
        
        $vacancies = $query;
        $featuredVacancies = Vacancy::getFeaturedVacancies(3);
        
        return view('careers.vacancy', compact('vacancies', 'featuredVacancies'));
    }

    /**
     * Display specific vacancy details.
     */
    public function show($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        
        // Increment views
        $vacancy->incrementViews();
        
        // Get related vacancies
        $relatedVacancies = Vacancy::where('id', '!=', $id)
            ->where('is_active', true)
            ->where(function($query) use ($vacancy) {
                $query->where('category', $vacancy->category)
                      ->orWhere('department', $vacancy->department);
            })
            ->limit(3)
            ->get();
        
        return view('careers.show', compact('vacancy', 'relatedVacancies'));
    }
}

