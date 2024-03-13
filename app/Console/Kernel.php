<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Bill_Ibr;
use App\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        date_default_timezone_set("Asia/Karachi");

        Bill_Ibr::updateBalanceLog();

        Bill_Ibr::updateJobBalanceLog();
        
        $schedule->call(function () {
 
            // $log = new Log;
            // $log->user_id = 1;
            // $log->activity = "Stats Updated At ". date("h:i:sa");
            // $log->date = date('Y/m/d');
            // $log->time = date("h:i:sa");
            // $log->service = 'Stats';
            // $log->save();
        })->everyMinute();
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
