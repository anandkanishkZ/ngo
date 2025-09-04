<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
            'inquiry_type' => 'required|string|in:general,volunteer,partnership,media,support',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please correct the errors below.');
        }

        try {
            // In a real application, you would send an email here
            // For now, we'll just return a success message
            
            // Example email sending code:
            // Mail::send('emails.contact', $request->all(), function($message) use ($request) {
            //     $message->to('info@hopefoundation.org')
            //             ->subject('Contact Form: ' . $request->subject)
            //             ->replyTo($request->email, $request->name);
            // });

            return back()->with('success', 'Thank you for your message! We will get back to you within 24 hours.');
            
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Sorry, there was an error sending your message. Please try again or contact us directly.');
        }
    }
}
