<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    public function show()
    {
        // Generate random numbers for CAPTCHA
        $captcha_a = rand(1, 10);
        $captcha_b = rand(1, 10);
        
        return view('contact', compact('captcha_a', 'captcha_b'));
    }
    
    public function submit(Request $request)
    {
        try {
            // Anti-spam checks
            $this->performAntiSpamChecks($request);
        
        // Validate the form data
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefoon' => 'nullable|string|max:20',
            'onderwerp' => 'required|string|in:letselschade,verkeer,werk,medisch,slip,vraag,anders',
            'bericht' => 'required|string|max:2000',
            'captcha_answer' => 'required|numeric',
            'captcha_a' => 'required|integer',
            'captcha_b' => 'required|integer',
            'privacy_akkoord' => 'required|accepted',
            'timestamp' => 'required|integer'
        ], [
            'naam.required' => 'Naam is verplicht.',
            'naam.max' => 'Naam mag maximaal 255 karakters bevatten.',
            'email.required' => 'E-mailadres is verplicht.',
            'email.email' => 'Voer een geldig e-mailadres in.',
            'email.max' => 'E-mailadres mag maximaal 255 karakters bevatten.',
            'telefoon.max' => 'Telefoonnummer mag maximaal 20 karakters bevatten.',
            'onderwerp.required' => 'Selecteer een onderwerp.',
            'onderwerp.in' => 'Selecteer een geldig onderwerp.',
            'bericht.required' => 'Bericht is verplicht.',
            'bericht.max' => 'Bericht mag maximaal 2000 karakters bevatten.',
            'captcha_answer.required' => 'Anti-spam verificatie is verplicht.',
            'captcha_answer.numeric' => 'Voer een geldig getal in voor de anti-spam verificatie.',
            'privacy_akkoord.required' => 'U moet akkoord gaan met de privacyverklaring.',
            'privacy_akkoord.accepted' => 'U moet akkoord gaan met de privacyverklaring.'
        ]);
        
        // Verify CAPTCHA
        $expectedAnswer = $validatedData['captcha_a'] + $validatedData['captcha_b'];
        if ($validatedData['captcha_answer'] != $expectedAnswer) {
            return back()->withErrors(['captcha_answer' => 'Anti-spam verificatie is onjuist. Probeer het opnieuw.'])->withInput();
        }
        
        // Here you would typically send an email or save to database
        // For now, we'll just return a success message
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Uw bericht is succesvol verzonden. Wij nemen binnen 2 uur contact met u op.'
            ]);
        }
        
        return back()->with('success', 'Uw bericht is succesvol verzonden. Wij nemen binnen 2 uur contact met u op.');
        
        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Er is een serverfout opgetreden. Probeer het opnieuw.'
                ], 500);
            }
            
            return back()->withErrors(['general' => 'Er is een serverfout opgetreden. Probeer het opnieuw.'])->withInput();
        }
    }
    
    private function performAntiSpamChecks(Request $request)
    {
        // Check honeypot field (should be empty)
        if (!empty($request->input('website'))) {
            abort(403, 'Spam detected');
        }
        
        // Check timestamp (form should not be submitted too quickly)
        $timestamp = $request->input('timestamp');
        if ($timestamp && (time() - $timestamp) < 5) {
            abort(403, 'Form submitted too quickly');
        }
        
        // Check timestamp (form should not be submitted too late)
        if ($timestamp && (time() - $timestamp) > 3600) { // 1 hour
            abort(403, 'Form expired');
        }
        
        // Additional checks can be added here
        // - IP-based rate limiting
        // - Email domain validation
        // - Content analysis
    }
}
