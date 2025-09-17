<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function index()
    {
        // Debug: Let's see what's happening with the query
        $query = Notice::active()
                      ->published()
                      ->notExpired()
                      ->orderBy('sort_order')
                      ->orderBy('published_at', 'desc');
        
        // Debug: Get the SQL and count
        $sql = $query->toSql();
        $count = $query->count();
        \Log::info("Notices Query SQL: " . $sql);
        \Log::info("Notices Count: " . $count);
        
        $notices = $query->paginate(8);
        
        // Debug: Log the actual notices retrieved
        \Log::info("Paginated notices count: " . $notices->count());
        
        return view('notices.index', compact('notices'));
    }
    
    public function show(Notice $notice)
    {
        // Check if notice is accessible
        if (!$notice->is_active || $notice->status !== 'published' || $notice->is_expired) {
            abort(404);
        }
        
        return view('notices.show', compact('notice'));
    }
}
