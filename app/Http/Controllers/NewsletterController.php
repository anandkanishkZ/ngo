<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    /**
     * Store a newly created newsletter subscription.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletters,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first('email') ?? 'Please provide a valid email address.',
            ], 422);
        }

        try {
            Newsletter::create([
                'email' => $request->email,
                'ip_address' => $request->ip(),
                'subscribed_at' => now(),
                'is_active' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you! You have been successfully subscribed to our newsletter.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }

    /**
     * Unsubscribe from newsletter
     */
    public function unsubscribe(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:newsletters,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Email address not found in our records.',
            ], 422);
        }

        try {
            $newsletter = Newsletter::where('email', $request->email)->first();
            $newsletter->update([
                'is_active' => false,
                'unsubscribed_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'You have been successfully unsubscribed.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }
}
