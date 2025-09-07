<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact messages.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('inquiry_type')) {
            $query->where('inquiry_type', $request->inquiry_type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $messages = $query->latest()->paginate(15);

        // Get statistics
        $stats = [
            'total' => ContactMessage::count(),
            'unread' => ContactMessage::unread()->count(),
            'read' => ContactMessage::read()->count(),
            'replied' => ContactMessage::replied()->count(),
            'archived' => ContactMessage::archived()->count(),
        ];

    // Temporarily use the known-good clone to avoid raw blade rendering
    return view('dashboard.contact-messages.index_fixed', compact('messages', 'stats'));
    }

    /**
     * Display the specified contact message.
     */
    public function show(ContactMessage $contactMessage)
    {
        // Mark as read if it's unread
        if ($contactMessage->status === 'unread') {
            $contactMessage->markAsRead();
        }

        return view('dashboard.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Update the specified contact message status.
     */
    public function updateStatus(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'status' => 'required|in:unread,read,replied,archived',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $contactMessage->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'read_at' => $request->status !== 'unread' ? now() : null
        ]);

        return back()->with('success', 'Contact message status updated successfully.');
    }

    /**
     * Remove the specified contact message.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return back()->with('success', 'Contact message deleted successfully.');
    }

    /**
     * Bulk update contact messages.
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'messages' => 'required|array',
            'messages.*' => 'exists:contact_messages,id',
            'action' => 'required|in:mark_read,mark_replied,archive,delete'
        ]);

        $messages = ContactMessage::whereIn('id', $request->messages);

        switch ($request->action) {
            case 'mark_read':
                $messages->update(['status' => 'read', 'read_at' => now()]);
                $message = 'Selected messages marked as read.';
                break;
            case 'mark_replied':
                $messages->update(['status' => 'replied']);
                $message = 'Selected messages marked as replied.';
                break;
            case 'archive':
                $messages->update(['status' => 'archived']);
                $message = 'Selected messages archived.';
                break;
            case 'delete':
                $messages->delete();
                $message = 'Selected messages deleted.';
                break;
        }

        return back()->with('success', $message);
    }

    /**
     * Export contact messages to CSV.
     */
    public function export(Request $request)
    {
        $query = ContactMessage::query();

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('inquiry_type')) {
            $query->where('inquiry_type', $request->inquiry_type);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $messages = $query->latest()->get();

        $filename = 'contact_messages_' . now()->format('Y_m_d_H_i_s') . '.csv';

        return response()->streamDownload(function() use ($messages) {
            $handle = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($handle, [
                'ID', 'Name', 'Email', 'Phone', 'Subject', 'Message', 
                'Inquiry Type', 'Status', 'IP Address', 'Submitted At', 'Read At'
            ]);

            // CSV data
            foreach ($messages as $message) {
                fputcsv($handle, [
                    $message->id,
                    $message->name,
                    $message->email,
                    $message->phone,
                    $message->subject,
                    $message->message,
                    $message->inquiry_type_formatted,
                    $message->status,
                    $message->ip_address,
                    $message->created_at->format('Y-m-d H:i:s'),
                    $message->read_at ? $message->read_at->format('Y-m-d H:i:s') : ''
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
