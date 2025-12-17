<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JustMineTravelAIController extends Controller
{
   public function suggestDestinations(Request $request)
{
    $weather = $request->input('weather');

    $prompt = "Suggest 4 international cities that are perfect for \"$weather\" weather. Reply ONLY with a raw JSON array like [\"Paris\", \"Dubai\", \"Miami\", \"Tokyo\"] without any explanation.";

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('OPENAI_SECRET_KEY'),
    ])->post('https://api.openai.com/v1/chat/completions', [
        'model' => 'gpt-4o',
        'messages' => [
            ['role' => 'user', 'content' => $prompt]
        ],
        'temperature' => 0.7,
    ]);

    if ($response->successful()) {
        $content = $response->json()['choices'][0]['message']['content'];

        // استخراج الJSON من الرد إن كان فيه شرح زائد بالغلط
        $start = strpos($content, '[');
        $end = strrpos($content, ']');
        $json = substr($content, $start, $end - $start + 1);

        $suggestions = json_decode($json, true);

        if (is_array($suggestions)) {
            return response()->json(['destinations' => $suggestions]);
        }
    }

    return response()->json(['error' => 'Failed to get destinations.'], 500);
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

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('OPENAI_SECRET_KEY'),
    ])->post('https://api.openai.com/v1/chat/completions', [
        'model' => 'gpt-4o',
        'messages' => [
            ['role' => 'user', 'content' => $prompt]
        ],
        'temperature' => 0.8,
    ]);

    if ($response->successful()) {
        return response()->json([
            'reply' => $response->json()['choices'][0]['message']['content']
        ]);
    }

    return response()->json(['error' => 'Failed to generate travel plan.'], 500);
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
