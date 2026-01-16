<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Jobs\FetchNewsJob;
use App\Jobs\FetchMarketDataJob;
use App\Jobs\FetchCricketScoreJob;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::job(new FetchNewsJob)->everyTenMinutes();
Schedule::job(new FetchMarketDataJob)->everyMinute();
Schedule::job(new FetchCricketScoreJob)->everyThirtySeconds();

