<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RapidApiService
{
    protected string $apiKey;
    protected string $host;
    protected int $timeout = 30;

    public function __construct()
    {
        $this->apiKey = config('services.rapidapi.key');
        $this->host = config('services.rapidapi.host', 'zilyo.p.rapidapi.com');
    }

    /**
     * Make HTTP request to RapidAPI
     */
    protected function makeRequest(string $endpoint, array $params = [], string $method = 'GET'): array
    {
        if (empty($this->apiKey)) {
            throw new \Exception('RapidAPI key is not configured. Please set RAPIDAPI_KEY in your .env file.');
        }

        try {
            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'X-RapidAPI-Key' => $this->apiKey,
                    'X-RapidAPI-Host' => $this->host,
                ])
                ->{strtolower($method)}("https://{$this->host}/{$endpoint}", $params);

            if ($response->successful()) {
                return $response->json();
            }

            // Handle rate limiting
            if ($response->status() === 429) {
                Log::warning('RapidAPI rate limit exceeded', ['endpoint' => $endpoint]);
                throw new \Exception('API rate limit exceeded. Please try again later.');
            }

            // Log error response
            $errorBody = $response->json();
            $errorMessage = $errorBody['message'] ?? $errorBody['error'] ?? $response->body();
            
            Log::error('RapidAPI request failed', [
                'endpoint' => $endpoint,
                'status' => $response->status(),
                'response' => $response->body(),
                'error_message' => $errorMessage,
            ]);

            throw new \Exception("API request failed with status: {$response->status()}. Message: " . (is_string($errorMessage) ? $errorMessage : json_encode($errorMessage)));

        } catch (\Exception $e) {
            Log::error('RapidAPI service error', [
                'endpoint' => $endpoint,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Get region ID for a location using regions endpoint
     */
    protected function getRegionId(string $location, string $domain = 'US', string $locale = 'en_US'): ?string
    {
        try {
            // Use regions endpoint to get region_id
            $response = $this->makeRequest('v2/regions', [
                'query' => $location,
                'domain' => $domain,
                'locale' => $locale,
            ]);
            
            // Log the response structure for debugging
            Log::info('Region lookup response', ['response' => $response]);
            
            // Try different response structures
            if (isset($response['data']) && is_array($response['data']) && !empty($response['data'])) {
                $firstItem = $response['data'][0];
                $regionId = $firstItem['gaiaId'] ?? $firstItem['regionId'] ?? $firstItem['id'] ?? $firstItem['region_id'] ?? null;
                // Convert to integer if numeric, ensure it's >= 1
                if ($regionId) {
                    $regionIdInt = is_numeric($regionId) ? (int)$regionId : (int)filter_var($regionId, FILTER_SANITIZE_NUMBER_INT);
                    if ($regionIdInt >= 1) {
                        return (string)$regionIdInt;
                    }
                }
            }
            
            if (isset($response['regions']) && is_array($response['regions']) && !empty($response['regions'])) {
                $regionId = $response['regions'][0]['gaiaId'] ?? $response['regions'][0]['regionId'] ?? $response['regions'][0]['id'] ?? null;
                if ($regionId) {
                    $regionIdInt = is_numeric($regionId) ? (int)$regionId : (int)filter_var($regionId, FILTER_SANITIZE_NUMBER_INT);
                    if ($regionIdInt >= 1) {
                        return (string)$regionIdInt;
                    }
                }
            }
            
            // If response is a single object
            if (isset($response['gaiaId'])) {
                $regionIdInt = is_numeric($response['gaiaId']) ? (int)$response['gaiaId'] : (int)filter_var($response['gaiaId'], FILTER_SANITIZE_NUMBER_INT);
                if ($regionIdInt >= 1) {
                    return (string)$regionIdInt;
                }
            }
            
            if (isset($response['regionId'])) {
                $regionIdInt = is_numeric($response['regionId']) ? (int)$response['regionId'] : (int)filter_var($response['regionId'], FILTER_SANITIZE_NUMBER_INT);
                if ($regionIdInt >= 1) {
                    return (string)$regionIdInt;
                }
            }
            
            return null;
        } catch (\Exception $e) {
            Log::warning('Failed to get region_id from regions endpoint', [
                'location' => $location,
                'error' => $e->getMessage(),
                'endpoint' => 'v2/regions'
            ]);
            
            // Try alternative: use a known region_id for common locations
            $knownRegions = [
                'Dubai' => '-2090194', // This is a placeholder - needs to be verified
                'New York' => '60763',
                'London' => '178062',
                'Paris' => '1456928',
            ];
            
            if (isset($knownRegions[$location])) {
                return $knownRegions[$location];
            }
            
            return null;
        }
    }

    /**
     * Search hotels by location using Zilyo API
     * Zilyo API has a simpler structure and returns JSON directly
     */
    public function searchHotels(string $location, string $checkIn, string $checkOut, int $adults = 2, array $options = []): array
    {
        $cacheKey = "rapidapi:hotels:{$location}:{$checkIn}:{$checkOut}:{$adults}";
        
        return Cache::remember($cacheKey, 3600, function () use ($location, $checkIn, $checkOut, $adults, $options) {
            // Zilyo API parameters - simpler structure
            $params = [
                'location' => $location,
                'checkin' => $checkIn,
                'checkout' => $checkOut,
                'adults' => $adults,
            ];
            
            // Add optional parameters
            if (isset($options['results'])) {
                $params['results'] = $options['results'];
            }
            if (isset($options['page'])) {
                $params['page'] = $options['page'];
            }
            
            // Merge with additional options
            $params = array_merge($params, $options);
            
            // Zilyo API endpoint
            try {
                $response = $this->makeRequest('search', $params);
                return $response;
            } catch (\Exception $e) {
                // If Zilyo fails, log and rethrow
                Log::error('Zilyo API request failed', ['error' => $e->getMessage()]);
                throw $e;
            }
        });
    }

    /**
     * Get detailed hotel information
     */
    public function getHotelDetails(string $hotelId, string $checkIn = null, string $checkOut = null): array
    {
        $cacheKey = "rapidapi:hotel:{$hotelId}:{$checkIn}:{$checkOut}";
        
        return Cache::remember($cacheKey, 3600, function () use ($hotelId, $checkIn, $checkOut) {
            $params = [];
            if ($checkIn && $checkOut) {
                $params['checkin_date'] = $checkIn;
                $params['checkout_date'] = $checkOut;
            }

            return $this->makeRequest("v2/hotels/details", array_merge(['id' => $hotelId], $params));
        });
    }

    /**
     * Search car rentals
     * Note: Cars API might have different endpoints - this is a placeholder
     */
    public function searchCars(string $location, string $pickupDate, string $dropoffDate, array $options = []): array
    {
        $cacheKey = "rapidapi:cars:{$location}:{$pickupDate}:{$dropoffDate}";
        
        return Cache::remember($cacheKey, 21600, function () use ($location, $pickupDate, $dropoffDate, $options) {
            // Note: Cars API endpoint may be different - check RapidAPI documentation
            // For now, return empty result as cars API might not be available in Hotels.com Provider
            throw new \Exception('Car rental search is not available in Hotels.com Provider API. Please use a different API provider for car rentals.');
            
            $params = array_merge([
                'pickup_location' => $location,
                'pickup_date' => $pickupDate,
                'dropoff_date' => $dropoffDate,
            ], $options);

            return $this->makeRequest('v2/cars/search', $params);
        });
    }

    /**
     * Get detailed car information
     */
    public function getCarDetails(string $carId, string $pickupDate = null, string $dropoffDate = null): array
    {
        $cacheKey = "rapidapi:car:{$carId}:{$pickupDate}:{$dropoffDate}";
        
        return Cache::remember($cacheKey, 21600, function () use ($carId, $pickupDate, $dropoffDate) {
            $params = ['id' => $carId];
            if ($pickupDate && $dropoffDate) {
                $params['pickup_date'] = $pickupDate;
                $params['dropoff_date'] = $dropoffDate;
            }

            return $this->makeRequest('v2/cars/details', $params);
        });
    }

    /**
     * Clear cache for specific keys
     */
    public function clearCache(string $pattern = null): void
    {
        if ($pattern) {
            // Clear specific pattern (requires Redis or custom implementation)
            Cache::forget($pattern);
        } else {
            // Clear all RapidAPI cache
            // Note: This is a simplified version. For production, use cache tags if available
            Cache::flush();
        }
    }
}

