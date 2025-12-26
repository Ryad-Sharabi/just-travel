<?php

namespace App\Console\Commands;

use App\Jobs\SyncHotelsJob;
use App\Services\HotelSyncService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncHotels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotels:sync 
                            {location? : The location to sync hotels for (e.g., "Dubai", "New York")}
                            {--checkin= : Check-in date (Y-m-d format)}
                            {--checkout= : Check-out date (Y-m-d format)}
                            {--adults=2 : Number of adults}
                            {--queue : Run sync in background queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync hotels from RapidAPI to database';

    /**
     * Execute the console command.
     */
    public function handle(HotelSyncService $hotelSyncService): int
    {
        $location = $this->argument('location') ?? $this->ask('Enter location to sync hotels for', 'Dubai');
        $checkIn = $this->option('checkin') ?? now()->addDays(1)->format('Y-m-d');
        $checkOut = $this->option('checkout') ?? now()->addDays(3)->format('Y-m-d');
        $adults = (int) $this->option('adults');

        $this->info("Syncing hotels for: {$location}");
        $this->info("Check-in: {$checkIn}, Check-out: {$checkOut}, Adults: {$adults}");

        if ($this->option('queue')) {
            SyncHotelsJob::dispatch($location, $checkIn, $checkOut, $adults);
            $this->info('Hotel sync job queued successfully!');
            return Command::SUCCESS;
        }

        try {
            $this->info('Starting sync...');
            $result = $hotelSyncService->syncHotels($location, $checkIn, $checkOut, $adults);

            if ($result['success']) {
                $this->info("✅ Sync completed successfully!");
                $this->info("   Synced: {$result['synced']} hotels");
                $this->info("   Created: {$result['created']} new hotels");
                $this->info("   Updated: {$result['updated']} existing hotels");
                return Command::SUCCESS;
            } else {
                $this->error("❌ Sync failed: " . ($result['message'] ?? 'Unknown error'));
                return Command::FAILURE;
            }

        } catch (\Exception $e) {
            $this->error("❌ Error: " . $e->getMessage());
            Log::error('Hotel sync command failed', [
                'location' => $location,
                'error' => $e->getMessage(),
            ]);
            return Command::FAILURE;
        }
    }
}

