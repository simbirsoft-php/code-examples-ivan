<?php

namespace App\Providers;

use App\Services\CsvScheduleDataProviderService;
use App\Services\ScheduleService;
use Illuminate\Support\ServiceProvider;
use App\Contracts\ScheduleDataProvider as ScheduleDataProviderContract;
use App\Contracts\ScheduleService as ScheduleServiceContract;

class ScheduleDataProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ScheduleDataProviderContract::class, function ($app) {
            return new CsvScheduleDataProviderService();
        });
        $this->app->singleton(ScheduleServiceContract::class, function ($app) {
            return new ScheduleService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
