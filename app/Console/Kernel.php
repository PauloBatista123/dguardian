<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('dguardian:bloqueio-ausencia')->dailyAt('05:36')->timezone('America/Sao_Paulo');
        $schedule->command('dguardian:desbloquear-usuarios')->dailyAt('05:35')->timezone('America/Sao_Paulo');
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
