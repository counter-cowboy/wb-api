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
        // $schedule->command('inspire')->hourly();
        $schedule->command('import:incomes Electro')->everyMinute();
        $schedule->command('import:incomes Account')->twiceDailyAt(12,16, 21)->evenInMaintenanceMode();

        $schedule->command('import:orders Electro')->twiceDailyAt(9,16, 36)->evenInMaintenanceMode();
        $schedule->command('import:orders Account')->twiceDailyAt(9,16, 36)->evenInMaintenanceMode();

        $schedule->command('import:sales Electro')->twiceDailyAt(9,16, 36)->evenInMaintenanceMode();
        $schedule->command('import:sales Account')->twiceDailyAt(9,16, 36)->evenInMaintenanceMode();

        $schedule->command('import:stocks Account')->twiceDailyAt(9,16, 36)->evenInMaintenanceMode();
        $schedule->command('import:stocks Electro')->twiceDailyAt(9,16, 36)->evenInMaintenanceMode();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
