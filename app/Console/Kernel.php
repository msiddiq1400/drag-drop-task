<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    //run the below command to run scheduler locally and execute commands
    // php artisan schedule:work

    protected $commands = [];

    protected function schedule(Schedule $schedule)
    {
        
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}