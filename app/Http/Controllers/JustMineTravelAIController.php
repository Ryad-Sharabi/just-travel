<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JustMineTravelAIController extends Controller
{
    public function index()
    {
        return view('browse', ['activeTab' => 'ai', 'items' => []]);
    }

    public function suggestDestinations(Request $request)
    {
        $weather = $request->input('weather');

        $prompt = "Suggest 4 international cities that are perfect for \"$weather\" weather. Reply ONLY with a raw JSON array of strings like [\"City 1\", \"City 2\"] without markdown formatting.";

        $apiKey = config('services.gemini.key');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro-latest:generateContent?key={$apiKey}";

        try {
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post($url, [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => ['temperature' => 0.7]
                ]);

            if ($response->successful()) {
                $candidates = $response->json()['candidates'] ?? [];
                if (!empty($candidates)) {
                    $text = $candidates[0]['content']['parts'][0]['text'] ?? '';

                    // Clean Markdown
                    $text = preg_replace('/^```json\s*|```\s*$/', '', trim($text));
                    $text = preg_replace('/^```\s*|```\s*$/', '', $text);

                    // Find JSON array brackets
                    $start = strpos($text, '[');
                    $end = strrpos($text, ']');

                    if ($start !== false && $end !== false) {
                        $json = substr($text, $start, $end - $start + 1);
                        $suggestions = json_decode($json, true);

                        if (is_array($suggestions)) {
                            return response()->json(['destinations' => $suggestions]);
                        }
                    }
                }
            }
            return response()->json(['destinations' => []]); // Return empty if failed, handled by frontend
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function generate(Request $request)
    {
        $questions = [
            '1. What is your preferred weather?',               // 0
            '2. Destination (choose one of the suggestions)',   // 1
            '3. What is your approximate budget?',              // 2
            '4. Departure city?',                               // 3
            '5. Preferred type of accommodation?',              // 4
            '6. Preferred means of transportation during the trip?', // 5
            '7. Any preferred type of food or cuisine?',        // 6
            '8. Duration of the trip?',                         // 7
            '9. What is your main purpose for this trip?',      // 8
            '10. How many people are traveling with you?',      // 9
            '11. Should we recommend the cheapest flight or a specific airline?' // 10
        ];

        $answers = $request->input('answers');

        if (!is_array($answers) || count($answers) !== count($questions)) {
            return response()->json(['error' => 'Invalid or incomplete answers.'], 422);
        }

        // نفس منطقك القديم
        $combinedAnswers = implode(' ', $answers);
        $language = $this->detectLanguage($combinedAnswers);

        // نستخدم المدينة ومدة الرحلة عشان الـ events
        $destination = $answers[1] ?? '';
        $tripDuration = $answers[7] ?? '';

        $prompt = <<<EOT
You are a smart travel agent. Based on the user's answers below, generate a full travel plan with the following:

1. Match the departure city and destination correctly (never make them the same).
2. Include a breakdown of:
   - Suggested flight options (airlines, prices, reason).
   - 4 hotel options (name, price/night, reason).
   - 4 car rental options (company, price/day, reason).
   - 4 restaurant options based on cuisine.
3. Generate a 3–7 day itinerary based on trip duration.
4. At the end, show a summary of total estimated budget.
5. Add a separate section titled "Local Events & Activities in {$destination}" that suggests 4–6 realistic events or activities in that city that fit a "{$tripDuration}" trip. For each event or activity include:
   - Name
   - Short description
   - Approximate price (or say "Free" if appropriate)
   - Why it matches the user's preferences.
6. If you don't know exact real-time events, suggest typical recurring events and activities (like city tours, museums, cultural shows, festivals, food experiences, nightlife, etc.) that are realistic for that city.
7. Reply in this language: {$language}
8. Answer only based on the questions/answers listed.

Questions are in English, but answers may be in another language.
Please reply in {$language} language.

EOT;

        // نضيف الأسئلة + الأجوبة كما هي بدون ما نزيد عليهم سؤال جديد
        foreach ($questions as $index => $question) {
            $answer = $answers[$index] ?? '';
            $prompt .= "\n" . ($index + 1) . ". " . $question . " " . $answer;
        }

        $apiKey = config('services.gemini.key');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro-latest:generateContent?key={$apiKey}";

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(120) // Increase timeout to 120 seconds for full generation
                ->post($url, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.8,
                    ]
                ]);

            if ($response->successful()) {
                $candidates = $response->json()['candidates'] ?? [];
                if (!empty($candidates)) {
                    return response()->json([
                        'reply' => $candidates[0]['content']['parts'][0]['text'] ?? ''
                    ]);
                }
            }

            return response()->json([
                'error' => 'Gemini API Error',
                'details' => $response->json()
            ], $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function detectLanguage($text)
    {
        if (preg_match('/[\x{0600}-\x{06FF}]/u', $text)) {
            return 'arabic';
        }
        if (preg_match('/[\x{4E00}-\x{9FFF}]/u', $text)) {
            return 'chinese';
        }
        return 'english';
    }
}
