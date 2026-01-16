<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle contact form submission.
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string',
            'message' => 'required|string|max:2000',
        ]);

        // Here you can:
        // 1. Send email to admin
        // 2. Save to database
        // 3. Send notification

        // Example: Log to file for now
        \Log::info('Contact Form Submission', $validated);

        // Optional: Send email
        // Mail::to('admin@smartdose.com')->send(new ContactFormMail($validated));

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}