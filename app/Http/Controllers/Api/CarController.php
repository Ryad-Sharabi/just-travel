<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Car::query();

            // Filter by city
            if ($request->has('city')) {
                $query->where('city', 'like', '%' . $request->city . '%');
            }

            // Filter by price range
            if ($request->has('min_price')) {
                $query->where(function ($q) use ($request) {
                    $q->where('price_per_day', '>=', $request->min_price)
                        ->orWhere('price', '>=', $request->min_price);
                });
            }

            if ($request->has('max_price')) {
                $query->where(function ($q) use ($request) {
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

            $cars = $query->get();

            return response()->json($cars);

        } catch (\Exception $e) {
            \Log::error('Car API Error: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to fetch cars',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
