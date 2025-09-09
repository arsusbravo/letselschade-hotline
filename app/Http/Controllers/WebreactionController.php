<?php

namespace App\Http\Controllers;

use App\Http\Services\WebreactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebreactionController extends Controller
{
    protected $webreactionService;
    protected $apiUsername;
    protected $apiPassword;
    protected $postal_code_id;
    protected $postal_code_letters;
    protected $house_number;
    protected $webmodule_id;

    public function __construct(WebreactionService $webreactionService)
    {
        $this->webreactionService = $webreactionService;
        $this->apiUsername = 'api@ongevalclaimen.nl';
        $this->apiPassword = 'c8MaUXZ6';

        $this->postal_code_id = '4825';
        $this->postal_code_letters = 'AM';
        $this->house_number = '8';
        $this->webmodule_id = 11;
    }

    public function contact(Request $request)
    {
        // Time-based validation (check if form was submitted too quickly)
        $form_start_time = $request->input('form_start_time');
        $submission_time = time() - $form_start_time;

        // Honeypot check (if the hidden field is filled, it's a bot)
        if ($submission_time > 5 && empty($request->input('website'))) {
            // Validate the incoming request
            $validated = $request->validate([
                'gender' => 'required|string',
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email' => 'required|string|email',
                'telephone' => 'nullable|string',
                'subject' => 'required|string',
                'details' => 'required|string',
            ]);

            $userData = [
                'api_username' => $this->apiUsername,
                'api_password' => $this->apiPassword,
            ];

            $requestData = [
                'request' => [
                    'contact_mail' => $request->all()
                ],
                'user' => $userData
            ];
            

            try {
                // Set session flag to allow access to thank you page
                session(['form_submitted' => true, 'submission_time' => time()]);

                $type = 'error';
                $messages = '';
                
                // Call the external API
                $response = $this->webreactionService->storeData($requestData);
                
                Log::info('Webreaction contact API response:', $response);

                if(isset($response['contact_mail'])) 
                {
                    if ($response['contact_mail']['success']) {
                        $type = 'success';
                        $messages = $response['contact_mail']['success'];
                    } else {
                        $messages = $response['contact_mail']['validate'];
                    }
                } else {
                    // If no specific response structure, assume success
                    $type = 'success';
                    $messages = 'Uw bericht is succesvol verzonden. Wij nemen zo snel mogelijk contact met u op.';
                }

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => $type === 'success',
                        'message' => $messages,
                        'redirect' => url('/thank-you')
                    ]);
                }
                return redirect()->back()->with($type . '_msg', $messages);
            } catch (\Exception $e) {
                // Handle the error (log it, show error message, etc.)
                Log::error('Webreaction contact error: ' . $e->getMessage());
                
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Er is een fout opgetreden bij het verzenden van uw bericht.'
                    ], 500);
                }
                return redirect()->back()->with('error_msg', 'Er is een fout opgetreden bij het verzenden van uw bericht.');
            }

        }
        
        // Anti-spam triggered
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Spam gedetecteerd. Probeer het opnieuw.'
            ], 422);
        }
        return redirect()->back()->with('error_msg', 'Spam gedetecteerd. Probeer het opnieuw.');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email',
            'telephone' => 'required|string',
            'details' => 'string',
        ]);

        $userData = [
            'api_username' => $this->apiUsername,
            'api_password' => $this->apiPassword,
        ];

        switch ($request->input('soort_ongeval')) {
            case 'bedrijf':
                $lead_type_id = 2;
                break;
            case 'dier':
                $lead_type_id = 5;
                break;
            case 'wegdek':
                $lead_type_id = 7;
                break;
            case 'sportschool':
                $lead_type_id = 4;
                break;
            default:
                $lead_type_id = 1;
                break;
        }

        $webreactionData = [
            'webmodule_id' => $this->webmodule_id,
            'lead_webreaction_type_id' => 1,
            'domain_name' => $request->getHost(),
            'lead_type_id' => $lead_type_id,
            'reference' => null,
            'gender' => $request->input('gender', 'u'),
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'details' => $validated['details'],
            'house_number' => $this->house_number,
            'postal_code_id' => $this->postal_code_id,
            'postal_code_letters' => $this->postal_code_letters,
            'json_details' => $this->buildJsonDetails($request)
        ];

        $requestData = [
            'request' => [
                'register_webreaction' => $webreactionData
            ],
            'user' => $userData
        ];

        // For now, return success without calling external API
        try {
            // Set session flag to allow access to thank you page
            session(['form_submitted' => true, 'submission_time' => time()]);
            
            // Uncomment this section when external API is ready
            $success = false;
            $messages = [];
            $response = $this->webreactionService->storeData($requestData);

            Log::info('webreaction', $response);

            if(
                isset($response['register_webreaction']) && 
                $response['register_webreaction']['error'] === false && 
                $response['register_webreaction']['id']) 
            {
                $success = true;
                $requestMail = [
                    'request' => [
                        'webreactionclaim_mail' => $webreactionData
                    ],
                    'user' => $userData
                ];
                $response = $this->webreactionService->storeData($requestMail);
            } else if ($response['register_webreaction']['error']) {
                $messages = $response['register_webreaction']['validate'];
            }

            return response()->json([
                'success' => $success,
                'message' => $messages,
                'redirect' => url('/thank-you')
            ]);
        } catch (\Exception $e) {
            // Handle the error (log it, show error message, etc.)
            Log::error('Webreaction error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Er is een fout opgetreden bij het verwerken van uw aanvraag. Probeer het opnieuw.',
            ]);
        }
    }

    /**
     * Build json_details array from form data
     * Maps form questions to their answers
     */
    private function buildJsonDetails(Request $request)
    {
        $jsonDetails = [];
        
        // Map form fields to their question labels
        $fieldMappings = [
            // Step 1 - Soort ongeval
            'soort_ongeval' => 'Wat voor soort ongeval heeft u meegemaakt?',
            
            // Step 2 - Wanneer gebeurde het ongeval
            'ongeval_datum' => 'Wanneer heeft het ongeval plaatsgevonden?',
            'tegenpartij' => 'Is de tegenpartij bekend?',
            'snel_hulp' => 'Heeft u snel hulp nodig?',
            
            // Step 3 - Wat gebeurde er precies
            'letsel_beschrijving' => 'Welke letsels heeft u opgelopen?',
            'schade_ernst' => 'Hoe ernstig is de schade?',
            'schade_omschrijving' => 'Beschrijf de opgelopen schade',
            'leeftijd' => 'Wat is uw leeftijd?',
            
            // Step 4 - Extra hulp
            'extra_hulp' => 'Heeft u extra hulp nodig gehad?',
            
            // Step 5 - Contact details
            'availableTime' => 'Wanneer bent u het beste te bereiken?',
            'details' => 'Eventuele vragen en/of opmerkingen',
            'newsletter' => 'Ik wil op de hoogte blijven van letselschade nieuws'
        ];
        
        // Process each field mapping
        foreach ($fieldMappings as $fieldName => $question) {
            $value = $request->input($fieldName);
            
            if ($value !== null && $value !== '') {
                // Handle special cases
                if ($fieldName === 'extra_hulp') {
                    // Convert array to comma-separated string
                    if (is_array($value)) {
                        $value = implode(', ', $value);
                    }
                } elseif ($fieldName === 'newsletter') {
                    // Convert checkbox to readable text
                    $value = $value ? 'Ja' : 'Nee';
                } elseif ($fieldName === 'availableTime') {
                    // Convert time to readable format
                    $value = $value . ':00 uur';
                }
                
                $jsonDetails[$question] = $value;
            }
        }
        
        return $jsonDetails;
    }
}

