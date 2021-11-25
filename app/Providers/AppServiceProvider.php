<?php

namespace App\Providers;

use App\Charts\RevenueChart;
use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts) {
        Paginator::useBootstrap();

        $charts->register([
            RevenueChart::class
        ]);
    }
}
