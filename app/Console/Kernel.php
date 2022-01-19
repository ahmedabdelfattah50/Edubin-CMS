<?php

namespace App\Console;

use App\Console\Commands\WriterAutoMail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        WriterAutoMail::class
    ];


    protected function schedule(Schedule $schedule)
    {
        $schedule->command('writer:autoMail')->everyMinute();
    }


    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
