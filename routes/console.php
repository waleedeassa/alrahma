<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

// db backup
Schedule::command('backup:run')->dailyAt('13:52')->timezone('Africa/Casablanca')->withoutOverlapping();
