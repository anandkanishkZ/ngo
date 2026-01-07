<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display ongoing projects
     */
    public function ongoing(): View
    {
        $projects = Project::ongoing()
            ->orderBy('sort_order')
            ->orderBy('start_date', 'desc')
            ->paginate(9);

        $featuredProjects = Project::ongoing()
            ->featured()
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('projects.ongoing', compact('projects', 'featuredProjects'));
    }

    /**
     * Display completed projects
     */
    public function completed(): View
    {
        $projects = Project::completed()
            ->orderBy('end_date', 'desc')
            ->orderBy('sort_order')
            ->paginate(9);

        $featuredProjects = Project::completed()
            ->featured()
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('projects.completed', compact('projects', 'featuredProjects'));
    }

    /**
     * Display the specified project
     */
    public function show(Project $project): View
    {
        // Get related projects (same category, different project)
        $relatedProjects = Project::active()
            ->where('category', $project->category)
            ->where('id', '!=', $project->id)
            ->limit(3)
            ->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }

    /**
     * Display all projects (for general projects page)
     */
    public function index(): View
    {
        $ongoingProjects = Project::ongoing()
            ->featured()
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        $completedProjects = Project::completed()
            ->featured()
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        $totalOngoing = Project::ongoing()->count();
        $totalCompleted = Project::completed()->count();
        $totalBeneficiaries = Project::active()->sum('beneficiaries');
        $totalFundsRaised = Project::active()->sum('funds_raised');

        return view('projects.index', compact(
            'ongoingProjects',
            'completedProjects',
            'totalOngoing',
            'totalCompleted',
            'totalBeneficiaries',
            'totalFundsRaised'
        ));
    }
}
