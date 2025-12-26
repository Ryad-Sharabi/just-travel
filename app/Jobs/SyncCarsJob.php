<?php

namespace App\Jobs;

use App\Services\CarSyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncCarsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $location;
    protected ?string $pickupDate;
    protected ?string $dropoffDate;

    /**
     * Create a new job instance.
     */
    public function __construct(string $location, ?string $pickupDate = null, ?string $dropoffDate = null)
    {
        $this->location = $location;
        $this->pickupDate = $pickupDate;
        $this->dropoffDate = $dropoffDate;
    }

    /**
     * Execute the job.
     */
    public function handle(CarSyncService $carSyncService): void
    {
        try {
            Log::info('Starting car sync job', [
                'location' => $this->location,
                'pickup_date' => $this->pickupDate,
                'dropoff_date' => $this->dropoffDate,
            ]);

            $result = $carSyncService->syncCars(
                $this->location,
                $this->pickupDate,
                $this->dropoffDate
            );

            if ($result['success']) {
                Log::info('Car sync completed successfully', [
                    'location' => $this->location,
                    'synced' => $result['synced'],
                    'created' => $result['created'],
                    'updated' => $result['updated'],
                ]);
            } else {
                Log::warning('Car sync completed with errors', [
                    'location' => $this->location,
                    'message' => $result['message'] ?? 'Unknown error',
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Car sync job failed', [
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
        Log::error('Car sync job failed permanently', [
            'location' => $this->location,
            'error' => $exception->getMessage(),
        ]);
    }
}

