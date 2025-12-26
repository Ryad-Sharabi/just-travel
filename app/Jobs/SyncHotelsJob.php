<?php

namespace App\Jobs;

use App\Services\HotelSyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncHotelsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $location;
    protected ?string $checkIn;
    protected ?string $checkOut;
    protected int $adults;

    /**
     * Create a new job instance.
     */
    public function __construct(string $location, ?string $checkIn = null, ?string $checkOut = null, int $adults = 2)
    {
        $this->location = $location;
        $this->checkIn = $checkIn;
        $this->checkOut = $checkOut;
        $this->adults = $adults;
    }

    /**
     * Execute the job.
     */
    public function handle(HotelSyncService $hotelSyncService): void
    {
        try {
            Log::info('Starting hotel sync job', [
                'location' => $this->location,
                'check_in' => $this->checkIn,
                'check_out' => $this->checkOut,
            ]);

            $result = $hotelSyncService->syncHotels(
                $this->location,
                $this->checkIn,
                $this->checkOut,
                $this->adults
            );

            if ($result['success']) {
                Log::info('Hotel sync completed successfully', [
                    'location' => $this->location,
                    'synced' => $result['synced'],
                    'created' => $result['created'],
                    'updated' => $result['updated'],
                ]);
            } else {
                Log::warning('Hotel sync completed with errors', [
                    'location' => $this->location,
                    'message' => $result['message'] ?? 'Unknown error',
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Hotel sync job failed', [
                'location' => $this->location,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Re-throw to mark job as failed
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('Hotel sync job failed permanently', [
            'location' => $this->location,
            'error' => $exception->getMessage(),
        ]);
    }
}

