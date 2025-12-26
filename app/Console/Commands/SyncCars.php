<?php

namespace App\Console\Commands;

use App\Jobs\SyncCarsJob;
use App\Services\CarSyncService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncCars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cars:sync 
                            {location? : The location to sync cars for (e.g., "Dubai", "New York")}
                            {--pickup= : Pickup date (Y-m-d format)}
                            {--dropoff= : Dropoff date (Y-m-d format)}
                            {--queue : Run sync in background queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync cars from RapidAPI to database';

    /**
     * Execute the console command.
     */
    public function handle(CarSyncService $carSyncService): int
    {
        $location = $this->argument('location') ?? $this->ask('Enter location to sync cars for', 'Dubai');
        $pickupDate = $this->option('pickup') ?? now()->addDays(1)->format('Y-m-d');
        $dropoffDate = $this->option('dropoff') ?? now()->addDays(3)->format('Y-m-d');

        $this->info("Syncing cars for: {$location}");
        $this->info("Pickup: {$pickupDate}, Dropoff: {$dropoffDate}");

        if ($this->option('queue')) {
            SyncCarsJob::dispatch($location, $pickupDate, $dropoffDate);
            $this->info('Car sync job queued successfully!');
            return Command::SUCCESS;
        }

        try {
            $this->info('Starting sync...');
            $result = $carSyncService->syncCars($location, $pickupDate, $dropoffDate);

            if ($result['success']) {
                $this->info("✅ Sync completed successfully!");
                $this->info("   Synced: {$result['synced']} cars");
                $this->info("   Created: {$result['created']} new cars");
                $this->info("   Updated: {$result['updated']} existing cars");
                return Command::SUCCESS;
            } else {
                $this->error("❌ Sync failed: " . ($result['message'] ?? 'Unknown error'));
                return Command::FAILURE;
            }

        } catch (\Exception $e) {
            $this->error("❌ Error: " . $e->getMessage());
            Log::error('Car sync command failed', [
                'location' => $location,
                'error' => $e->getMessage(),
            ]);
            return Command::FAILURE;
        }
    }
}

