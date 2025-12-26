<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\UpdateHotelCoordinatesFromCsv::class,
    ];
    
    
    protected function schedule(Schedule $schedule): void
    {
        // Fetch flights daily at 2 AM
        $schedule->command('flights:fetch-daily')->dailyAt('02:00');
        
        // Sync hotels daily at 3 AM (off-peak hours)
        $schedule->command('hotels:sync Dubai --queue')->dailyAt('03:00');
        
        // Sync cars daily at 4 AM (off-peak hours)
        $schedule->command('cars:sync Dubai --queue')->dailyAt('04:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
