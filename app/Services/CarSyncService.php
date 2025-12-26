<?php

namespace App\Services;

use App\Models\Car;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CarSyncService
{
    protected RapidApiService $rapidApiService;

    public function __construct(RapidApiService $rapidApiService)
    {
        $this->rapidApiService = $rapidApiService;
    }

    /**
     * Sync cars from RapidAPI to database
     */
    public function syncCars(string $location, string $pickupDate = null, string $dropoffDate = null): array
    {
        $pickupDate = $pickupDate ?? now()->addDays(1)->format('Y-m-d');
        $dropoffDate = $dropoffDate ?? now()->addDays(3)->format('Y-m-d');

        try {
            $response = $this->rapidApiService->searchCars($location, $pickupDate, $dropoffDate);
            
            if (!isset($response['cars']) || empty($response['cars'])) {
                Log::warning('No cars found in RapidAPI response', ['location' => $location]);
                return ['success' => false, 'message' => 'No cars found', 'synced' => 0];
            }

            $synced = 0;
            $updated = 0;
            $created = 0;

            foreach ($response['cars'] as $carData) {
                try {
                    $transformedData = $this->transformCarData($carData, $pickupDate, $dropoffDate);
                    
                    $car = Car::updateOrCreate(
                        ['rapidapi_car_id' => $transformedData['rapidapi_car_id']],
                        $transformedData
                    );

                    if ($car->wasRecentlyCreated) {
                        $created++;
                    } else {
                        $updated++;
                    }
                    $synced++;

                } catch (\Exception $e) {
                    Log::error('Error syncing individual car', [
                        'car_id' => $carData['id'] ?? 'unknown',
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
            Log::error('Error syncing cars from RapidAPI', [
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
     * Transform RapidAPI car data to database format
     */
    protected function transformCarData(array $carData, string $pickupDate, string $dropoffDate): array
    {
        // Extract images
        $images = [];
        $imageUrl = null;

        if (isset($carData['images']) && is_array($carData['images'])) {
            foreach ($carData['images'] as $image) {
                if (isset($image['url'])) {
                    if (!$imageUrl) {
                        $imageUrl = $image['url'];
                    }
                    $images[] = $image['url'];
                }
            }
        }

        // Extract price
        $pricePerDay = null;
        if (isset($carData['price']['amount'])) {
            $pricePerDay = (float) $carData['price']['amount'];
        }

        // Generate booking URL
        $bookingUrl = $this->generateBookingUrl($carData['id'] ?? null, $pickupDate, $dropoffDate);

        // Extract brand and model from name or separate fields
        $name = $carData['name'] ?? $carData['vehicle']['name'] ?? '';
        $brand = $carData['brand'] ?? $carData['vehicle']['make'] ?? null;
        $model = $carData['model'] ?? $carData['vehicle']['model'] ?? null;

        // If brand/model not available, try to parse from name
        if (!$brand && $name) {
            $parts = explode(' ', $name);
            $brand = $parts[0] ?? null;
            $model = isset($parts[1]) ? implode(' ', array_slice($parts, 1)) : null;
        }

        return [
            'rapidapi_car_id' => $carData['id'] ?? null,
            'car_id' => $carData['id'] ?? null,
            'brand' => $brand,
            'model' => $model,
            'city' => $carData['location']['city'] ?? $carData['pickup_location'] ?? null,
            'image_url' => $imageUrl,
            'images' => $images,
            'category' => $carData['category'] ?? $carData['vehicle']['category'] ?? null,
            'seats' => $carData['seats'] ?? $carData['vehicle']['seats'] ?? null,
            'transmission' => $carData['transmission'] ?? $carData['vehicle']['transmission'] ?? null,
            'fuel_type' => $carData['fuel_type'] ?? $carData['vehicle']['fuel_type'] ?? null,
            'price_per_day' => $pricePerDay,
            'price' => $pricePerDay, // Keep for backward compatibility
            'currency' => $carData['price']['currency'] ?? 'USD',
            'booking_url' => $bookingUrl,
            'last_synced_at' => Carbon::now(),
        ];
    }

    /**
     * Generate booking URL with affiliate tracking
     */
    protected function generateBookingUrl(?string $carId, string $pickupDate, string $dropoffDate): ?string
    {
        if (!$carId) {
            return null;
        }

        // You can customize this URL with your affiliate ID
        // Example: https://www.rentalcars.com/CarRental?id=123&pickup=2024-12-20&dropoff=2024-12-22
        $baseUrl = 'https://www.rentalcars.com/CarRental';
        return $baseUrl . '?id=' . $carId . '&pickup=' . $pickupDate . '&dropoff=' . $dropoffDate;
    }

    /**
     * Sync a single car by ID
     */
    public function syncCarById(string $carId, string $pickupDate = null, string $dropoffDate = null): bool
    {
        try {
            $pickupDate = $pickupDate ?? now()->addDays(1)->format('Y-m-d');
            $dropoffDate = $dropoffDate ?? now()->addDays(3)->format('Y-m-d');

            $response = $this->rapidApiService->getCarDetails($carId, $pickupDate, $dropoffDate);
            
            if (!isset($response['car'])) {
                Log::warning('Car not found in RapidAPI', ['car_id' => $carId]);
                return false;
            }

            $carData = $this->transformCarData($response['car'], $pickupDate, $dropoffDate);
            
            Car::updateOrCreate(
                ['rapidapi_car_id' => $carId],
                $carData
            );

            return true;

        } catch (\Exception $e) {
            Log::error('Error syncing car by ID', [
                'car_id' => $carId,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}

