<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::active()
                        ->published()
                        ->notExpired()
                        ->orderBy('sort_order')
                        ->orderBy('published_at', 'desc')
                        ->paginate(8);
        
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
