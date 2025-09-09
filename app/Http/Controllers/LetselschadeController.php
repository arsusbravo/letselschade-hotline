<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class LetselschadeController extends Controller
{
    public function submit(Request $request)
    {
        try {
            // Validate the form data
            $validatedData = $request->validate([
            'ongeval' => 'required|string|in:verkeer,bedrijf,dier,wegdek,sportschool',
            'datum_ongeval' => 'required|date|before_or_equal:today|after:' . now()->subYears(10)->format('Y-m-d'),
            'tegenpartij' => 'required|string|in:ja,nee',
            'snel_hulp' => 'required|string|in:ja,nee',
            'letsel' => 'required|string|max:1000',
            'schade_ernst' => 'required|string|in:licht,matig,ernstig',
            'schade_omschrijving' => 'required|string|max:1000',
            'arbeidsongeschiktheid' => 'required|string|in:geen,gedeeltelijk,volledig',
            'leeftijd' => 'required|integer|min:18|max:100',
            'extra_hulp' => 'array',
            'extra_hulp.*' => 'string|in:huishouding,kinderopvang,huisbezoek',
            'naam' => 'required|string|max:255',
            'telefoon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'privacy_akkoord' => 'required|accepted',
            'newsletter' => 'nullable|string|in:true,false'
        ], [
            // Custom error messages in Dutch
            'ongeval.required' => 'Selecteer alstublieft het soort ongeval.',
            'datum_ongeval.required' => 'Datum van het ongeval is verplicht.',
            'datum_ongeval.date' => 'Voer een geldige datum in.',
            'datum_ongeval.before_or_equal' => 'De datum kan niet in de toekomst liggen.',
            'datum_ongeval.after' => 'De datum mag niet meer dan 10 jaar geleden zijn.',
            'tegenpartij.required' => 'Selecteer alstublieft of de tegenpartij bekend is.',
            'snel_hulp.required' => 'Selecteer alstublieft of u snel geholpen wilt worden.',
            'letsel.required' => 'Korte omschrijving van het letsel is verplicht.',
            'letsel.max' => 'Letselomschrijving mag maximaal 1000 karakters bevatten.',
            'schade_ernst.required' => 'Selecteer alstublieft de ernst van de schade.',
            'schade_omschrijving.required' => 'Korte omschrijving van de schade is verplicht.',
            'schade_omschrijving.max' => 'Schadeomschrijving mag maximaal 1000 karakters bevatten.',
            'arbeidsongeschiktheid.required' => 'Selecteer alstublieft de mate van arbeidsongeschiktheid.',
            'ondernemer.required' => 'Selecteer alstublieft of u zelfstandig ondernemer bent.',
            'leeftijd.required' => 'Leeftijd is verplicht.',
            'leeftijd.integer' => 'Leeftijd moet een geldig getal zijn.',
            'leeftijd.min' => 'U moet minimaal 18 jaar oud zijn.',
            'leeftijd.max' => 'Voer een geldige leeftijd in.',
            'naam.required' => 'Naam is verplicht.',
            'naam.max' => 'Naam mag maximaal 255 karakters bevatten.',
            'telefoon.required' => 'Telefoonnummer is verplicht.',
            'email.required' => 'E-mailadres is verplicht.',
            'email.email' => 'Voer een geldig e-mailadres in.',
            'privacy_akkoord.required' => 'U moet akkoord gaan met de privacyverklaring.',
            'privacy_akkoord.accepted' => 'U moet akkoord gaan met de privacyverklaring.'
        ]);

        } catch (ValidationException $e) {
            // Handle validation errors for AJAX requests
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Er zijn enkele problemen met uw invoer.',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e; // Re-throw for normal requests
        }

        try {
            // Log the submission for tracking
            Log::info('Letselschade form submitted', [
                'naam' => $validatedData['naam'],
                'email' => $validatedData['email'],
                'ongeval_type' => $validatedData['ongeval'],
                'ernst' => $validatedData['schade_ernst']
            ]);

            // Here you could save to database, send email, etc.
            // For now, we'll just flash a success message
            
            // You could also send an email notification here:
            /*
            Mail::send('emails.letselschade-submission', $validatedData, function($message) use ($validatedData) {
                $message->to('info@letselschade-hotline.nl')
                        ->subject('Nieuwe letselschade aanvraag van ' . $validatedData['naam']);
            });
            */

            // Set session flag to allow access to thank you page
            session(['form_submitted' => true, 'submission_time' => time()]);
            
            // Check if this is an AJAX request
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Bedankt voor uw aanvraag! Wij nemen binnen 2 uur contact met u op om uw situatie te bespreken.',
                    'redirect' => url('/thank-you')
                ]);
            }

            return redirect()->route('thank-you');

        } catch (\Exception $e) {
            Log::error('Error processing letselschade form', [
                'error' => $e->getMessage(),
                'email' => $request->input('email')
            ]);

            // Check if this is an AJAX request
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Er is een fout opgetreden bij het verwerken van uw aanvraag. Probeer het opnieuw of neem direct contact met ons op.',
                    'errors' => ['general' => 'Er is een technische fout opgetreden.']
                ], 500);
            }

            return redirect()->back()
                ->withErrors(['Er is een fout opgetreden bij het verwerken van uw aanvraag. Probeer het opnieuw of neem direct contact met ons op.'])
                ->withInput();
        }
    }

    public function thankYou(Request $request)
    {
        // Check if user has permission to access this page
        if (!session('form_submitted') || !session('submission_time')) {
            return redirect()->route('home')->with('error', 'Deze pagina is alleen toegankelijk na het indienen van een aanvraag.');
        }

        // Check if submission is not too old (24 hours)
        $submissionTime = session('submission_time');
        if (time() - $submissionTime > 86400) { // 24 hours
            session()->forget(['form_submitted', 'submission_time']);
            return redirect()->route('home')->with('error', 'Deze pagina is verlopen. Vul het formulier opnieuw in.');
        }

        // Clear the session flags after showing the page
        session()->forget(['form_submitted', 'submission_time']);

        return view('thank-you');
    }
}
