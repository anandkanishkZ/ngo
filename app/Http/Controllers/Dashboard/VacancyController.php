<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VacancyController extends Controller
{
    /**
     * Display a listing of vacancies.
     */
    public function index(Request $request)
    {
        $query = Vacancy::orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true)->where('deadline', '>=', Carbon::today());
            } elseif ($request->status === 'expired') {
                $query->where('deadline', '<', Carbon::today());
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        $vacancies = $query->paginate(15);

        return view('dashboard.vacancies.index', compact('vacancies'));
    }

    /**
     * Show the form for creating a new vacancy.
     */
    public function create()
    {
        return view('dashboard.vacancies.create');
    }

    /**
     * Store a newly created vacancy in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|string',
            'number_of_positions' => 'required|integer|min:1',
            'experience_required' => 'nullable|string|max:255',
            'education_level' => 'nullable|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
            'skills' => 'nullable|string',
            'benefits' => 'nullable|string',
            'how_to_apply' => 'nullable|string',
            'application_email' => 'nullable|email',
            'application_phone' => 'nullable|string|max:20',
            'deadline' => 'required|date|after:today',
            'published_date' => 'nullable|date',
            'department' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'is_urgent' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        // Set published date to today if not provided
        if (empty($validated['published_date'])) {
            $validated['published_date'] = Carbon::today();
        }

        Vacancy::create($validated);

        return redirect()->route('dashboard.vacancies.index')
            ->with('success', 'Vacancy posted successfully!');
    }

    /**
     * Display the specified vacancy.
     */
    public function show(Vacancy $vacancy)
    {
        return view('dashboard.vacancies.show', compact('vacancy'));
    }

    /**
     * Show the form for editing the specified vacancy.
     */
    public function edit(Vacancy $vacancy)
    {
        return view('dashboard.vacancies.edit', compact('vacancy'));
    }

    /**
     * Update the specified vacancy in storage.
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|string',
            'number_of_positions' => 'required|integer|min:1',
            'experience_required' => 'nullable|string|max:255',
            'education_level' => 'nullable|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
            'skills' => 'nullable|string',
            'benefits' => 'nullable|string',
            'how_to_apply' => 'nullable|string',
            'application_email' => 'nullable|email',
            'application_phone' => 'nullable|string|max:20',
            'deadline' => 'required|date',
            'published_date' => 'nullable|date',
            'department' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'is_urgent' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $vacancy->update($validated);

        return redirect()->route('dashboard.vacancies.index')
            ->with('success', 'Vacancy updated successfully!');
    }

    /**
     * Remove the specified vacancy from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();

        return redirect()->route('dashboard.vacancies.index')
            ->with('success', 'Vacancy deleted successfully!');
    }

    /**
     * Toggle vacancy active status
     */
    public function toggleStatus(Vacancy $vacancy)
    {
        $vacancy->is_active = !$vacancy->is_active;
        $vacancy->save();

        return back()->with('success', 'Vacancy status updated successfully!');
    }

    /**
     * Toggle vacancy featured status
     */
    public function toggleFeatured(Vacancy $vacancy)
    {
        $vacancy->is_featured = !$vacancy->is_featured;
        $vacancy->save();

        return back()->with('success', 'Vacancy featured status updated successfully!');
    }

    /**
     * Toggle vacancy urgent status
     */
    public function toggleUrgent(Vacancy $vacancy)
    {
        $vacancy->is_urgent = !$vacancy->is_urgent;
        $vacancy->save();

        return back()->with('success', 'Vacancy urgent status updated successfully!');
    }
}
