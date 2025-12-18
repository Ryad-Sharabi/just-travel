<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flight;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('flights')
            ->leftJoin('airports as origin_airport', 'flights.origin_code', '=', 'origin_airport.iata_code')
            ->leftJoin('airports as dest_airport', 'flights.destination_code', '=', 'dest_airport.iata_code')
            ->select(
                'flights.airline',
                'flights.price',
                'flights.duration',
                'flights.departure_date',
                'flights.origin_code',
                'flights.destination_code',
                'origin_airport.country_name as origin_city',
                'origin_airport.name as origin_airport_name',
                'dest_airport.country_name as dest_city',
                'dest_airport.name as dest_airport_name'
            );

        if ($request->has('origin')) {
            $query->where('flights.origin_code', $request->origin);
        }

        if ($request->has('destination')) {
            $query->where('flights.destination_code', $request->destination);
        }

        if ($request->has('date')) {
            $query->where('flights.departure_date', $request->date);
        }

        return response()->json($query->orderBy('flights.price')->get());
    }
}
