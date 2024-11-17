<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('parse:kwork')->everyThirtyMinutes();
Schedule::command('queue:work --max-time=300 --tries=3')->everyFiveMinutes();
