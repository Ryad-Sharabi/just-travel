<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;

class BrowseController extends Controller
{
    public function index()
    {
        // Fetch airports for the 'Airports' tab
        $items = Airport::select('name', 'country_name', 'latitude', 'longitude', 'iata_code')->get();
        return view('browse', ['items' => $items, 'activeTab' => 'airports']);
    }

    public function hotels()
    {
        // Fetch only first 50 hotels to prevent page freezing
        $items = \App\Models\Hotel::select(
            'id',
            'name',
            'city',
            'latitude',
            'longitude',
            'hotel_id',
            'price',
            'price_per_night',
            'image_url',
            'images',
            'rating',
            'review_count',
            'description',
            'amenities',
            'currency',
            'booking_url'
        )
            ->limit(50)
            ->get();
        
        $totalCount = \App\Models\Hotel::count();
        $hasMore = $totalCount > 50;
        
        return view('browse', [
            'items' => $items, 
            'activeTab' => 'hotels',
            'hasMore' => $hasMore,
            'totalCount' => $totalCount,
            'loadedCount' => $items->count()
        ]);
    }

    public function loadMoreHotels(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = 50;
        
        $hotels = \App\Models\Hotel::select(
            'id',
            'name',
            'city',
            'latitude',
            'longitude',
            'hotel_id',
            'price',
            'price_per_night',
            'image_url',
            'images',
            'rating',
            'review_count',
            'description',
            'amenities',
            'currency',
            'booking_url'
        )
            ->skip($offset)
            ->take($limit)
            ->get();
        
        $totalCount = \App\Models\Hotel::count();
        $hasMore = ($offset + $limit) < $totalCount;
        
        return response()->json([
            'hotels' => $hotels,
            'hasMore' => $hasMore,
            'totalCount' => $totalCount,
            'loadedCount' => $offset + $hotels->count()
        ]);
    }
    public function cars()
    {
        // Fetch cars and map fields to match the generic 'browse' view expectations
        $items = \App\Models\Car::select(
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
            'booking_url'
        )->get()->map(function ($car) {
            $car->name = trim(($car->brand ?? '') . ' ' . ($car->model ?? ''));
            // Cars might not have lat/long for map, so we'll use null -> logic in view will handle visual
            $car->latitude = null;
            $car->longitude = null;
            return $car;
        });
        return view('browse', ['items' => $items, 'activeTab' => 'cars']);
    }
}
