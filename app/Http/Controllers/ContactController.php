<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Handle contact form submission.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'inquiry_type' => 'required|string|in:general,partnership,media,support',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please correct the errors below.');
        }

        try {
            // Save the contact message to database
            $contactMessage = ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'inquiry_type' => $request->inquiry_type,
                'ip_address' => $request->ip(),
                'status' => 'unread'
            ]);

            // Send email notification (optional)
            // Mail::send('emails.contact', $request->all(), function($message) use ($request) {
            //     $message->to('info@jidsnepal.org.np')
            //             ->subject('Contact Form: ' . $request->subject)
            //             ->replyTo($request->email, $request->name);
            // });

            return back()->with('success', 'Thank you for your message! We have received your inquiry and will get back to you within 24 hours.');
            
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Sorry, there was an error sending your message. Please try again or contact us directly.');
        }
    }
}
