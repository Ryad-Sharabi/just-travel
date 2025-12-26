<?php

namespace App\Services;

use App\Models\Hotel;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class HotelSyncService
{
    protected RapidApiService $rapidApiService;

    public function __construct(RapidApiService $rapidApiService)
    {
        $this->rapidApiService = $rapidApiService;
    }

    /**
     * Sync hotels from RapidAPI to database
     */
    public function syncHotels(string $location, string $checkIn = null, string $checkOut = null, int $adults = 2): array
    {
        $checkIn = $checkIn ?? now()->addDays(1)->format('Y-m-d');
        $checkOut = $checkOut ?? now()->addDays(3)->format('Y-m-d');

        try {
            $response = $this->rapidApiService->searchHotels($location, $checkIn, $checkOut, $adults);
            
            // Log full response for debugging
            Log::info('RapidAPI hotels search response', [
                'location' => $location,
                'response_keys' => array_keys($response),
                'has_properties' => isset($response['properties']),
                'has_propertySearchListings' => isset($response['propertySearchListings']),
                'properties_count' => isset($response['properties']) ? count($response['properties']) : 0,
                'listings_count' => isset($response['propertySearchListings']) ? count($response['propertySearchListings']) : 0,
            ]);
            
            // Try to get hotels from different response structures
            // Zilyo API returns results directly in 'results' array
            $properties = [];
            
            if (isset($response['results']) && !empty($response['results'])) {
                // Zilyo API structure
                $properties = $response['results'];
            } elseif (isset($response['properties']) && !empty($response['properties'])) {
                // Hotels.com Provider API structure
                $properties = $response['properties'];
            } elseif (isset($response['propertySearchListings']) && !empty($response['propertySearchListings'])) {
                // Extract actual hotel data from LodgingCard objects
                // The Hotels.com API returns GraphQL-style responses with LodgingCard objects
                foreach ($response['propertySearchListings'] as $index => $listing) {
                    // Skip placeholders and sponsored content
                    if (isset($listing['__typename'])) {
                        if ($listing['__typename'] === 'PropertySearchListingPlaceholder' || 
                            $listing['__typename'] === 'SponsoredContentPlacement') {
                            continue;
                        }
                    }
                    
                    // Log first listing to understand structure (full structure for debugging)
                    if ($index === 0) {
                        Log::info('First listing structure (full)', [
                            'index' => $index,
                            'typename' => $listing['__typename'] ?? 'none',
                            'all_keys' => array_keys($listing),
                            'full_structure' => json_encode($listing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
                        ]);
                    }
                    
                    // Try different property locations in the response
                    // Hotels.com API might nest data differently
                    $propertyData = null;
                    
                    if (isset($listing['property']) && is_array($listing['property'])) {
                        $propertyData = $listing['property'];
                    } elseif (isset($listing['lodging']) && is_array($listing['lodging'])) {
                        $propertyData = $listing['lodging'];
                    } elseif (isset($listing['data']) && is_array($listing['data'])) {
                        $propertyData = $listing['data'];
                    } elseif (isset($listing['id']) || isset($listing['name'])) {
                        // If it has id or name, might be direct property data
                        $propertyData = $listing;
                    }
                    
                    if ($propertyData && (isset($propertyData['id']) || isset($propertyData['name']))) {
                        $properties[] = $propertyData;
                    } else {
                        // Try to extract from nested structures
                        // Some GraphQL responses have deeply nested data
                        $propertyData = $this->extractPropertyFromNestedStructure($listing);
                        if ($propertyData) {
                            $properties[] = $propertyData;
                        }
                    }
                }
            }
            
            // Log how many properties we found
            Log::info('Properties extracted', ['count' => count($properties)]);
            
            // If still no properties but we have listings, try to use getHotelDetails for each
            if (empty($properties) && isset($response['propertySearchListings']) && !empty($response['propertySearchListings'])) {
                Log::info('Attempting to extract hotel IDs from listings for detail fetching');
                
                $hotelIds = [];
                foreach ($response['propertySearchListings'] as $listing) {
                    // Try to find hotel ID in various locations
                    $hotelId = $listing['id'] ?? 
                               $listing['propertyId'] ?? 
                               $listing['property']['id'] ?? 
                               $listing['lodging']['id'] ?? 
                               $listing['data']['id'] ?? null;
                    
                    if ($hotelId && !in_array($hotelId, $hotelIds)) {
                        $hotelIds[] = $hotelId;
                    }
                }
                
                // Try to fetch details for first few hotels
                if (!empty($hotelIds)) {
                    Log::info('Found hotel IDs, attempting to fetch details', ['count' => count($hotelIds), 'ids' => array_slice($hotelIds, 0, 5)]);
                    
                    // Limit to first 10 to avoid too many API calls
                    $hotelIds = array_slice($hotelIds, 0, 10);
                    
                    foreach ($hotelIds as $hotelId) {
                        try {
                            $hotelDetails = $this->rapidApiService->getHotelDetails($hotelId, $checkIn, $checkOut);
                            if (isset($hotelDetails['property']) || isset($hotelDetails['data'])) {
                                $property = $hotelDetails['property'] ?? $hotelDetails['data'] ?? $hotelDetails;
                                if (isset($property['id']) || isset($property['name'])) {
                                    $properties[] = $property;
                                }
                            }
                        } catch (\Exception $e) {
                            Log::warning('Failed to fetch hotel details', ['hotel_id' => $hotelId, 'error' => $e->getMessage()]);
                            continue;
                        }
                    }
                }
            }
            
            // If still no properties, the API is returning GraphQL-style response
            // The Hotels.com Provider API on RapidAPI returns LodgingCard objects with only __typename
            // This is a known limitation - the API may require:
            // 1. Different endpoint (e.g., /v2/hotels/list instead of /v2/hotels/search)
            // 2. Additional parameters to request full data
            // 3. GraphQL query parameters to specify which fields to return
            // 4. A different API provider that returns structured JSON
            if (empty($properties) && isset($response['summary']['matchedPropertiesSize']) && $response['summary']['matchedPropertiesSize'] > 0) {
                Log::warning('Properties array is empty but summary shows matched properties', [
                    'matched_size' => $response['summary']['matchedPropertiesSize'],
                    'response_structure' => 'GraphQL response with LodgingCard objects containing only __typename',
                    'suggestion' => 'Check RapidAPI documentation for Hotels.com Provider API - may need different endpoint or parameters',
                ]);
                
                return [
                    'success' => false, 
                    'message' => 'API returned GraphQL response with empty properties. The Hotels.com Provider API may require different parameters or endpoint. Please check RapidAPI documentation or consider using a different hotel API provider.', 
                    'synced' => 0,
                    'matched_hotels' => $response['summary']['matchedPropertiesSize'] ?? 0,
                ];
            }
            
            if (empty($properties)) {
                Log::warning('No hotels found in RapidAPI response', [
                    'location' => $location,
                    'response_keys' => array_keys($response),
                    'summary' => $response['summary'] ?? null,
                ]);
                return ['success' => false, 'message' => 'No hotels found', 'synced' => 0];
            }

            $synced = 0;
            $updated = 0;
            $created = 0;

            foreach ($properties as $property) {
                try {
                    $hotelData = $this->transformHotelData($property, $checkIn, $checkOut);
                    
                    $hotel = Hotel::updateOrCreate(
                        ['rapidapi_hotel_id' => $hotelData['rapidapi_hotel_id']],
                        $hotelData
                    );

                    if ($hotel->wasRecentlyCreated) {
                        $created++;
                    } else {
                        $updated++;
                    }
                    $synced++;

                } catch (\Exception $e) {
                    Log::error('Error syncing individual hotel', [
                        'hotel_id' => $property['id'] ?? 'unknown',
                        'error' => $e->getMessage(),
                    ]);
                    continue;
                }
            }

            return [
                'success' => true,
                'synced' => $synced,
                'created' => $created,
                'updated' => $updated,
            ];

        } catch (\Exception $e) {
            Log::error('Error syncing hotels from RapidAPI', [
                'location' => $location,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => $e->getMessage(),
                'synced' => 0,
            ];
        }
    }

    /**
     * Extract property data from nested GraphQL structure
     */
    protected function extractPropertyFromNestedStructure(array $listing): ?array
    {
        // Recursively search for property-like data
        $propertyKeys = ['id', 'name', 'propertyId', 'hotelId'];
        
        foreach ($propertyKeys as $key) {
            if (isset($listing[$key])) {
                // Found a property identifier, try to build property object
                $property = [
                    'id' => $listing['id'] ?? $listing['propertyId'] ?? $listing['hotelId'] ?? null,
                    'name' => $listing['name'] ?? $listing['propertyName'] ?? $listing['title'] ?? null,
                ];
                
                // Try to extract other fields
                if (isset($listing['images'])) {
                    $property['images'] = $listing['images'];
                }
                if (isset($listing['rating'])) {
                    $property['rating'] = $listing['rating'];
                }
                if (isset($listing['price'])) {
                    $property['price'] = $listing['price'];
                }
                
                return $property;
            }
        }
        
        // Recursively search in nested arrays
        foreach ($listing as $value) {
            if (is_array($value) && !empty($value)) {
                $found = $this->extractPropertyFromNestedStructure($value);
                if ($found) {
                    return $found;
                }
            }
        }
        
        return null;
    }

    /**
     * Transform RapidAPI hotel data to database format
     * Supports both Zilyo API and Hotels.com Provider API structures
     */
    protected function transformHotelData(array $property, string $checkIn, string $checkOut): array
    {
        // Check if this is Zilyo API structure
        $isZilyo = isset($property['provider']) || isset($property['lat']) || isset($property['lng']);
        
        if ($isZilyo) {
            return $this->transformZilyoData($property, $checkIn, $checkOut);
        }
        
        // Hotels.com Provider API structure (original)
        // Extract images
        $images = [];
        $imageUrl = null;

        if (isset($property['images']) && is_array($property['images'])) {
            foreach ($property['images'] as $image) {
                if (isset($image['url'])) {
                    if (!$imageUrl) {
                        $imageUrl = $image['url'];
                    }
                    $images[] = $image['url'];
                }
            }
        }

        // Extract amenities
        $amenities = [];
        if (isset($property['amenities']) && is_array($property['amenities'])) {
            foreach ($property['amenities'] as $amenity) {
                if (isset($amenity['name'])) {
                    $amenities[] = $amenity['name'];
                }
            }
        }

        // Get price from ratePlan if available
        $pricePerNight = null;
        if (isset($property['ratePlan']['price']['current'])) {
            $priceStr = $property['ratePlan']['price']['current'];
            // Remove currency symbols and extract number
            $pricePerNight = (float) preg_replace('/[^0-9.]/', '', $priceStr);
        }

        // Generate booking URL (you can customize this with affiliate tracking)
        $bookingUrl = $this->generateBookingUrl($property['id'] ?? null, $checkIn, $checkOut);

        return [
            'rapidapi_hotel_id' => $property['id'] ?? null,
            'name' => $property['name'] ?? null,
            'hotel_id' => $property['id'] ?? null,
            'city' => $property['destination']['name'] ?? null,
            'country_code' => $property['destination']['country'] ?? null,
            'latitude' => $property['coordinate']['lat'] ?? null,
            'longitude' => $property['coordinate']['lon'] ?? null,
            'address' => $property['address']['streetAddress'] ?? null,
            'image_url' => $imageUrl,
            'images' => $images,
            'rating' => isset($property['starRating']) ? (float) $property['starRating'] : null,
            'review_count' => $property['guestReviews']['total'] ?? null,
            'description' => $property['overview'] ?? null,
            'amenities' => $amenities,
            'price_per_night' => $pricePerNight,
            'price' => $pricePerNight, // Keep for backward compatibility
            'currency' => $property['ratePlan']['price']['currency'] ?? 'USD',
            'booking_url' => $bookingUrl,
            'last_synced_at' => Carbon::now(),
        ];
    }
    
    /**
     * Transform Zilyo API hotel data to database format
     */
    protected function transformZilyoData(array $property, string $checkIn, string $checkOut): array
    {
        // Extract images from Zilyo structure
        $images = [];
        $imageUrl = null;
        
        if (isset($property['photos']) && is_array($property['photos'])) {
            foreach ($property['photos'] as $photo) {
                $photoUrl = is_string($photo) ? $photo : ($photo['url'] ?? $photo['src'] ?? null);
                if ($photoUrl) {
                    if (!$imageUrl) {
                        $imageUrl = $photoUrl;
                    }
                    $images[] = $photoUrl;
                }
            }
        }
        
        // Extract amenities
        $amenities = [];
        if (isset($property['amenities']) && is_array($property['amenities'])) {
            $amenities = $property['amenities'];
        }
        
        // Get price
        $pricePerNight = null;
        $currency = 'USD';
        
        if (isset($property['price'])) {
            $pricePerNight = is_numeric($property['price']) ? (float) $property['price'] : null;
        }
        
        if (isset($property['currency'])) {
            $currency = $property['currency'];
        }
        
        // Generate booking URL
        $bookingUrl = $property['url'] ?? $property['bookingUrl'] ?? $this->generateBookingUrl($property['id'] ?? null, $checkIn, $checkOut);
        
        return [
            'rapidapi_hotel_id' => $property['id'] ?? $property['listingId'] ?? null,
            'name' => $property['name'] ?? $property['title'] ?? null,
            'hotel_id' => $property['id'] ?? $property['listingId'] ?? null,
            'city' => $property['city'] ?? $property['location']['city'] ?? null,
            'country_code' => $property['country'] ?? $property['location']['country'] ?? null,
            'latitude' => $property['lat'] ?? $property['latitude'] ?? $property['location']['lat'] ?? null,
            'longitude' => $property['lng'] ?? $property['longitude'] ?? $property['location']['lng'] ?? null,
            'address' => $property['address'] ?? $property['location']['address'] ?? null,
            'image_url' => $imageUrl,
            'images' => $images,
            'rating' => isset($property['rating']) ? (float) $property['rating'] : null,
            'review_count' => $property['reviewCount'] ?? $property['reviews'] ?? null,
            'description' => $property['description'] ?? $property['overview'] ?? null,
            'amenities' => $amenities,
            'price_per_night' => $pricePerNight,
            'price' => $pricePerNight,
            'currency' => $currency,
            'booking_url' => $bookingUrl,
            'last_synced_at' => Carbon::now(),
        ];
    }

    /**
     * Generate booking URL with affiliate tracking
     */
    protected function generateBookingUrl(?string $hotelId, string $checkIn, string $checkOut): ?string
    {
        if (!$hotelId) {
            return null;
        }

        // You can customize this URL with your affiliate ID
        // Example: https://www.hotels.com/ho123456?checkin=2024-12-20&checkout=2024-12-22
        $baseUrl = 'https://www.hotels.com/ho' . $hotelId;
        return $baseUrl . '?checkin=' . $checkIn . '&checkout=' . $checkOut;
    }

    /**
     * Sync a single hotel by ID
     */
    public function syncHotelById(string $hotelId, string $checkIn = null, string $checkOut = null): bool
    {
        try {
            $checkIn = $checkIn ?? now()->addDays(1)->format('Y-m-d');
            $checkOut = $checkOut ?? now()->addDays(3)->format('Y-m-d');

            $response = $this->rapidApiService->getHotelDetails($hotelId, $checkIn, $checkOut);
            
            if (!isset($response['property'])) {
                Log::warning('Hotel not found in RapidAPI', ['hotel_id' => $hotelId]);
                return false;
            }

            $hotelData = $this->transformHotelData($response['property'], $checkIn, $checkOut);
            
            Hotel::updateOrCreate(
                ['rapidapi_hotel_id' => $hotelId],
                $hotelData
            );

            return true;

        } catch (\Exception $e) {
            Log::error('Error syncing hotel by ID', [
                'hotel_id' => $hotelId,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}

