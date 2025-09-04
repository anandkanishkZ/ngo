<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.notices.index', compact('notices'));
    }

    public function create()
    {
        return view('dashboard.notices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'author' => 'required|string|max:100',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:draft,published,archived',
            'category' => 'nullable|string|max:100',
            'expires_at' => 'nullable|date|after:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/notices', $imageName);
            $data['image'] = $imageName;
        }

        // Set published_at if status is published and not set
        if ($data['status'] === 'published' && !$data['published_at']) {
            $data['published_at'] = now();
        }

        Notice::create($data);

        return redirect()->route('dashboard.notices.index')
                        ->with('success', 'Notice created successfully!');
    }

    public function show(Notice $notice)
    {
        return view('dashboard.notices.show', compact('notice'));
    }

    public function edit(Notice $notice)
    {
        return view('dashboard.notices.edit', compact('notice'));
    }

    public function update(Request $request, Notice $notice)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'author' => 'required|string|max:100',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:draft,published,archived',
            'category' => 'nullable|string|max:100',
            'expires_at' => 'nullable|date|after:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($notice->image && Storage::exists('public/notices/' . $notice->image)) {
                Storage::delete('public/notices/' . $notice->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/notices', $imageName);
            $data['image'] = $imageName;
        }

        // Set published_at if status changed to published and not set
        if ($data['status'] === 'published' && !$notice->published_at && !$data['published_at']) {
            $data['published_at'] = now();
        }

        $notice->update($data);

        return redirect()->route('dashboard.notices.index')
                        ->with('success', 'Notice updated successfully!');
    }

    public function destroy(Notice $notice)
    {
        try {
            // Delete associated image
            if ($notice->image && Storage::exists('public/notices/' . $notice->image)) {
                Storage::delete('public/notices/' . $notice->image);
            }
            
            $notice->delete();
            
            return redirect()->route('dashboard.notices.index')
                            ->with('success', 'Notice deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.notices.index')
                            ->with('error', 'Error deleting notice: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Notice $notice)
    {
        $notice->update([
            'is_active' => !$notice->is_active
        ]);

        $status = $notice->is_active ? 'activated' : 'deactivated';
        
        return redirect()->back()->with('success', "Notice {$status} successfully!");
    }

    public function toggleFeatured(Notice $notice)
    {
        $notice->update([
            'is_featured' => !$notice->is_featured
        ]);

        $status = $notice->is_featured ? 'featured' : 'unfeatured';
        
        return redirect()->back()->with('success', "Notice {$status} successfully!");
    }

    public function quickPublish(Notice $notice)
    {
        $notice->update([
            'status' => 'published',
            'published_at' => $notice->published_at ?? now(),
            'is_active' => true
        ]);

        return redirect()->back()->with('success', 'Notice published successfully!');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,publish,archive,delete',
            'notices' => 'required|array',
            'notices.*' => 'exists:notices,id'
        ]);

        $notices = Notice::whereIn('id', $request->notices);
        
        switch ($request->action) {
            case 'activate':
                $notices->update(['is_active' => true]);
                $message = 'Selected notices activated successfully!';
                break;
            case 'deactivate':
                $notices->update(['is_active' => false]);
                $message = 'Selected notices deactivated successfully!';
                break;
            case 'publish':
                $notices->update([
                    'status' => 'published',
                    'published_at' => now(),
                    'is_active' => true
                ]);
                $message = 'Selected notices published successfully!';
                break;
            case 'archive':
                $notices->update(['status' => 'archived']);
                $message = 'Selected notices archived successfully!';
                break;
            case 'delete':
                $notices->each(function($notice) {
                    if ($notice->image && Storage::exists('public/notices/' . $notice->image)) {
                        Storage::delete('public/notices/' . $notice->image);
                    }
                });
                $notices->delete();
                $message = 'Selected notices deleted successfully!';
                break;
        }

        return redirect()->back()->with('success', $message);
    }
}
