<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateHotelCoordinatesFromCSV extends Command
{
    protected $signature = 'hotels:update-coordinates';
    protected $description = 'Update hotel coordinates from a CSV file';

    public function handle()
    {
        $path = storage_path('app/Hotel_Coordinates.csv');

        if (!file_exists($path)) {
            $this->error("File not found: $path");
            return;
        }

        $rows = array_map('str_getcsv', file($path));
        $updated = 0;

        foreach ($rows as $row) {
            $hotelName = trim($row[0]);
            $latitude = isset($row[1]) ? floatval($row[1]) : null;
            $longitude = isset($row[2]) ? floatval($row[2]) : null;

            if ($latitude && $longitude) {
                DB::table('hotels')
                    ->where('name', $hotelName)
                    ->update([
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'updated_at' => now(),
                    ]);
                $updated++;
            }
        }

        $this->info("Done. Updated {$updated} hotels.");
    }
}
