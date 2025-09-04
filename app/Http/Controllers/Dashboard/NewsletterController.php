<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display newsletter subscribers
     */
    public function index()
    {
        $subscribers = Newsletter::orderBy('created_at', 'desc')->paginate(20);
        
        $stats = [
            'total' => Newsletter::count(),
            'active' => Newsletter::active()->count(),
            'unsubscribed' => Newsletter::inactive()->count(),
            'today' => Newsletter::whereDate('created_at', today())->count(),
        ];

        return view('dashboard.newsletters.index', compact('subscribers', 'stats'));
    }

    /**
     * Show subscriber details
     */
    public function show(Newsletter $newsletter)
    {
        return view('dashboard.newsletters.show', compact('newsletter'));
    }

    /**
     * Delete a subscriber
     */
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        
        return redirect()->route('dashboard.newsletters.index')
            ->with('success', 'Subscriber deleted successfully.');
    }

    /**
     * Toggle subscriber status
     */
    public function toggleStatus(Newsletter $newsletter)
    {
        $newsletter->update([
            'is_active' => !$newsletter->is_active,
            'unsubscribed_at' => !$newsletter->is_active ? now() : null,
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $newsletter->is_active,
            'message' => $newsletter->is_active ? 'Subscriber reactivated' : 'Subscriber deactivated',
        ]);
    }

    /**
     * Export subscribers
     */
    public function export()
    {
        $subscribers = Newsletter::active()->get();
        
        $csv = "Email,Subscribed Date,IP Address,Status\n";
        
        foreach ($subscribers as $subscriber) {
            $csv .= sprintf(
                "%s,%s,%s,%s\n",
                $subscriber->email,
                $subscriber->subscribed_at->format('Y-m-d H:i:s'),
                $subscriber->ip_address ?? 'N/A',
                $subscriber->status
            );
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="newsletter-subscribers.csv"');
    }
}
