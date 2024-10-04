<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Appelle la méthode pour envoyer les notifications tous les jours à minuit
       $schedule->command('app:check-rendez-vous')->dailyAt('20:00');
       $schedule->command('app:check-rendez-vous')->everyTenMinutes();
    }

    protected function commands()
    {
        // Charge tous les fichiers de commande artisan si tu en as
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

}