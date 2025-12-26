<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Services\CarSyncService;
use Carbon\Carbon;

class CarController extends Controller
{
    protected CarSyncService $carSyncService;

    public function __construct(CarSyncService $carSyncService)
    {
        $this->carSyncService = $carSyncService;
    }

    public function index(Request $request)
    {
        $query = Car::select(
            'id',
            'brand',
            'model',
            'city',
            'price',
            'price_per_day',
            'image_url',
            'images',
            'category',
            'seats',
            'transmission',
            'fuel_type',
            'currency',
            'booking_url',
            'last_synced_at'
        );

        if ($request->has('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // Filter by price range
        if ($request->has('min_price')) {
            $query->where(function($q) use ($request) {
                $q->where('price_per_day', '>=', $request->min_price)
                  ->orWhere('price', '>=', $request->min_price);
            });
        }

        if ($request->has('max_price')) {
            $query->where(function($q) use ($request) {
                $q->where('price_per_day', '<=', $request->max_price)
                  ->orWhere('price', '<=', $request->max_price);
            });
        }

        // Filter by category
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Filter by transmission
        if ($request->has('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        // Filter by fuel type
        if ($request->has('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        // Check if data is stale and needs refresh
        if ($request->has('refresh') || $this->isDataStale($query)) {
            if ($request->has('location')) {
                $this->carSyncService->syncCars($request->location);
            }
        }

        $cars = $query->get();
        return response()->json($cars);
    }

    /**
     * Check if car data is stale (older than 24 hours)
     */
    protected function isDataStale($query): bool
    {
        $oldestSync = $query->orderBy('last_synced_at', 'asc')->value('last_synced_at');
        
        if (!$oldestSync) {
            return true;
        }

        return Carbon::parse($oldestSync)->addHours(24)->isPast();
    }
}
