<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index()
    {
        $airports = Airport::select('name', 'country_name', 'latitude', 'longitude','iata_code')->get();

        return response()->json($airports);
    }
}
