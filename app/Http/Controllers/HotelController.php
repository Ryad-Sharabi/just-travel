<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Hotel::query();

            // Filter by city
            if ($request->has('city')) {
                $query->where('city', 'like', '%' . $request->city . '%');
            }

            // Filter by price range
            if ($request->has('min_price')) {
                $query->where(function ($q) use ($request) {
                    $q->where('price_per_night', '>=', $request->min_price)
                        ->orWhere('price', '>=', $request->min_price);
                });
            }

            if ($request->has('max_price')) {
                $query->where(function ($q) use ($request) {
                    $q->where('price_per_day', '<=', $request->max_price)
                        ->orWhere('price', '<=', $request->max_price);
                });
            }

            // Filter by rating
            if ($request->has('min_rating')) {
                $query->where('rating', '>=', $request->min_rating);
            }

            $hotels = $query->get();

            return response()->json($hotels);

        } catch (\Exception $e) {
            \Log::error('Hotel API Error: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to fetch hotels',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
