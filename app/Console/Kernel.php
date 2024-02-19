<?php

namespace App\Console;

use App\Jobs\getAllKabupatenFiles;
use App\Jobs\getdesa;
use App\Jobs\getdesakec;
use App\Jobs\getdesakode;
use App\Jobs\getkabkode;
use App\Jobs\getkabupaten;
use App\Jobs\getkecamatan;
use App\Jobs\getkeckab;
use App\Jobs\getkeckode;
use App\Jobs\getprovinsi;
use App\Jobs\gettoken;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Tests\Browser\KecamatanTest;

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
        $schedule->job(new gettoken)->yearly()->after(function () {});
        $schedule->job(new getprovinsi)->monthly()->after(function () {});
        $schedule->job(new getkabupaten)->monthly()->after(function () {});
        $schedule->job(new getAllKabupatenFiles)->monthly()->after(function () {});
        $schedule->job(new getkecamatan)->monthly()->after(function () {});
        $schedule->job(new getdesa)->monthly()->after(function () {});
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