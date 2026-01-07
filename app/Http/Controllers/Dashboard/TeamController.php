<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Display team members list
     */
    public function index(Request $request)
    {
        $query = TeamMember::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%");
            });
        }

        // Filter by department
        if ($request->filled('department')) {
            $query->where('department', $request->get('department'));
        }

        // Filter by status
        if ($request->filled('status')) {
            $status = $request->get('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Ordering
        $orderBy = $request->get('orderby', 'sort_order');
        $orderDir = $request->get('orderdir', 'asc');
        
        if ($orderBy === 'sort_order') {
            $query->orderBy('sort_order', $orderDir)->orderBy('name', 'asc');
        } else {
            $query->orderBy($orderBy, $orderDir);
        }

        $teamMembers = $query->paginate(12);
        $departments = TeamMember::getDepartments();

        return view('dashboard.team.index', compact('teamMembers', 'departments'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $departments = ['leadership', 'program', 'finance', 'marketing', 'operations', 'volunteer'];
        return view('dashboard.team.create', compact('departments'));
    }

    /**
     * Store new team member
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'department' => 'nullable|string|max:50',
            'joined_date' => 'nullable|date',
            'achievements' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'featured' => 'boolean',
        ]);

        try {
            $data = $request->except(['image']);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'team_' . Str::random(20) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/team'), $filename);
                $data['image'] = $filename;
            }

            // Set default sort order
            if (empty($data['sort_order'])) {
                $maxOrder = TeamMember::max('sort_order') ?? 0;
                $data['sort_order'] = $maxOrder + 10;
            }

            $teamMember = TeamMember::create($data);

            return redirect()
                ->route('dashboard.team.index')
                ->with('success', 'Team member added successfully!');

        } catch (\Exception $e) {
            Log::error('Team member creation error: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Failed to add team member. Please try again.');
        }
    }

    /**
     * Show team member details
     */
    public function show(TeamMember $team)
    {
        return view('dashboard.team.show', compact('team'));
    }

    /**
     * Show edit form
     */
    public function edit(TeamMember $team)
    {
        $departments = ['leadership', 'program', 'finance', 'marketing', 'operations', 'volunteer'];
        return view('dashboard.team.edit', compact('team', 'departments'));
    }

    /**
     * Update team member
     */
    public function update(Request $request, TeamMember $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'department' => 'nullable|string|max:50',
            'joined_date' => 'nullable|date',
            'achievements' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'featured' => 'boolean',
        ]);

        try {
            $data = $request->except(['image']);

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image
                $oldFile = basename($team->image);
                if ($oldFile && file_exists(public_path('uploads/team/' . $oldFile))) {
                    unlink(public_path('uploads/team/' . $oldFile));
                }

                $image = $request->file('image');
                $filename = 'team_' . Str::random(20) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/team'), $filename);
                $data['image'] = $filename;
            }

            $team->update($data);

            return redirect()
                ->route('dashboard.team.index')
                ->with('success', 'Team member updated successfully!');

        } catch (\Exception $e) {
            Log::error('Team member update error: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Failed to update team member. Please try again.');
        }
    }

    /**
     * Delete team member
     */
    public function destroy(TeamMember $team)
    {
        Log::info('Team member delete attempt', [
            'member_id' => $team->id,
            'member_name' => $team->name,
            'request_method' => request()->method(),
            'is_ajax' => request()->ajax()
        ]);
        
        try {
            // Delete image if exists
            $filename = basename($team->image);
            if ($filename && file_exists(public_path('uploads/team/' . $filename))) {
                unlink(public_path('uploads/team/' . $filename));
                Log::info('Team member image deleted', ['image' => $filename]);
            }

            $teamName = $team->name;
            $team->delete();
            
            Log::info('Team member deleted successfully', ['member_name' => $teamName]);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Team member '{$teamName}' deleted successfully!"
                ]);
            }

            return redirect()
                ->route('dashboard.team.index')
                ->with('success', "Team member '{$teamName}' deleted successfully!");

        } catch (\Exception $e) {
            Log::error('Team member deletion error', [
                'member_id' => $team->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete team member: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to delete team member: ' . $e->getMessage());
        }
    }

    /**
     * Toggle team member status
     */
    public function toggleStatus(TeamMember $team)
    {
        try {
            $team->update(['is_active' => !$team->is_active]);

            return response()->json([
                'success' => true,
                'message' => 'Team member status updated successfully!',
                'is_active' => $team->is_active
            ]);

        } catch (\Exception $e) {
            Log::error('Team member status toggle error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status.'
            ], 500);
        }
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(TeamMember $team)
    {
        try {
            $team->update(['featured' => !$team->featured]);

            return response()->json([
                'success' => true,
                'message' => 'Featured status updated successfully!',
                'featured' => $team->featured
            ]);

        } catch (\Exception $e) {
            Log::error('Team member featured toggle error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update featured status.'
            ], 500);
        }
    }
}
