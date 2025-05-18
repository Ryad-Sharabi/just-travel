<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AmadeusTokenManager
{
    public function getAccessToken()
    {
        return Cache::remember('amadeus_access_token', 1700, function () {
            $response = Http::asForm()->post('https://api.amadeus.com/v1/security/oauth2/token', [
                'grant_type'    => 'client_credentials',
                'client_id'     => config('services.amadeus.client_id'),
                'client_secret' => config('services.amadeus.client_secret'),
            ]);

            if (!$response->ok()) {
                throw new \Exception('فشل الحصول على access_token من Amadeus: ' . $response->body());
            }

            return $response->json()['access_token'];
        });
    }
}
