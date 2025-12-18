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
        // Fetch hotels
        $items = \App\Models\Hotel::select('name', 'city', 'latitude', 'longitude', 'hotel_id', 'price')->get();
        return view('browse', ['items' => $items, 'activeTab' => 'hotels']);
    }
    public function cars()
    {
        // Fetch cars and map fields to match the generic 'browse' view expectations
        $items = \App\Models\Car::select('brand', 'model', 'city', 'price', 'id')->get()->map(function ($car) {
            $car->name = $car->brand . ' ' . $car->model;
            // Cars might not have lat/long for map, so we'll use 0,0 or null -> logic in view will handle visual
            $car->latitude = null;
            $car->longitude = null;
            return $car;
        });
        return view('browse', ['items' => $items, 'activeTab' => 'cars']);
    }
}
