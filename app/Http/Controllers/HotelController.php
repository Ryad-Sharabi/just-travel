<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Services\HotelSyncService;
use Carbon\Carbon;

class HotelController extends Controller
{
    protected HotelSyncService $hotelSyncService;

    public function __construct(HotelSyncService $hotelSyncService)
    {
        $this->hotelSyncService = $hotelSyncService;
    }

    public function index(Request $request)
    {
        $query = Hotel::select(
            'id',
            'name',
            'city',
            'price',
            'price_per_night',
            'latitude',
            'longitude',
            'image_url',
            'images',
            'rating',
            'review_count',
            'description',
            'amenities',
            'currency',
            'booking_url',
            'last_synced_at'
        );

        // Filter by city
        if ($request->has('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // Filter by price range
        if ($request->has('min_price')) {
            $query->where(function($q) use ($request) {
                $q->where('price_per_night', '>=', $request->min_price)
                  ->orWhere('price', '>=', $request->min_price);
            });
        }

        if ($request->has('max_price')) {
            $query->where(function($q) use ($request) {
                $q->where('price_per_night', '<=', $request->max_price)
                  ->orWhere('price', '<=', $request->max_price);
            });
        }

        // Filter by rating
        if ($request->has('min_rating')) {
            $query->where('rating', '>=', $request->min_rating);
        }

        // Filter by amenities
        if ($request->has('amenities')) {
            $amenities = is_array($request->amenities) ? $request->amenities : [$request->amenities];
            foreach ($amenities as $amenity) {
                $query->whereJsonContains('amenities', $amenity);
            }
        }

        // Check if data is stale and needs refresh
        if ($request->has('refresh') || $this->isDataStale($query)) {
            if ($request->has('location')) {
                $this->hotelSyncService->syncHotels($request->location);
            }
        }

        return response()->json($query->get());
    }

    /**
     * Check if hotel data is stale (older than 24 hours)
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
