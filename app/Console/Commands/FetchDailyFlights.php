<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Airport;
use App\Models\Flight;

class FetchDailyFlights extends Command
{
    protected $signature = 'flights:fetch-daily';
    protected $description = 'Fetch daily flight offers from all airports using Amadeus API';

    public function handle()
{
    $auth = Http::asForm()->post('https://api.amadeus.com/v1/security/oauth2/token', [
        'grant_type' => 'client_credentials',
        'client_id' => env('AMADEUS_CLIENT_ID'),
        'client_secret' => env('AMADEUS_CLIENT_SECRET'),
    ]);

    $token = $auth->json()['access_token'];
    $airports = Airport::pluck('iata_code')->toArray();

    for ($i = 1; $i <= 7; $i++) {
        $departureDate = now()->addDays($i)->format('Y-m-d');
        $this->info("🔁 Fetching flights for $departureDate...");

        Flight::where('departure_date', $departureDate)->delete();

        foreach ($airports as $iata) {
            $destination = collect($airports)->filter(fn($code) => $code !== $iata)->random();

            $response = Http::withToken($token)->get('https://api.amadeus.com/v2/shopping/flight-offers', [
                'originLocationCode' => $iata,
                'destinationLocationCode' => $destination,
                'departureDate' => $departureDate,
                'adults' => 1,
                'max' => 15,
            ]);

            $data = $response->json();

            if ($response->successful() && isset($data['data'])) {
                foreach ($data['data'] as $flightData) {
                    $price = $flightData['price']['total'] ?? '0';
                    $carrier = $flightData['validatingAirlineCodes'][0] ?? 'Unknown';
                    $duration = $flightData['itineraries'][0]['duration'] ?? 'N/A';

                    Flight::create([
                        'origin_code' => $iata,
                        'destination_code' => $destination,
                        'airline' => $carrier,
                        'price' => $price,
                        'duration' => $duration,
                        'departure_date' => $departureDate,
                    ]);

                    $this->line("🛫 [$iata → $destination] $carrier | $price USD | $duration");
                }
            } else {
                $this->warn("⚠️ No flights from $iata on $departureDate");
            }
        }

        $this->info("✅ Done saving flights for $departureDate.");
    }

    return Command::SUCCESS;
}

}
