<?php

namespace App\Providers;

use App\Charts\RevenueChart;
//use Nabcellent\Chartisan\Registrar as Chartisan;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
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
    public function boot(/*Chartisan $chartisan*/) {
        Paginator::useBootstrap();

        if(config('app.env') === 'production') URL::forceScheme('https');

        /*$chartisan->register([
            RevenueChart::class
        ]);*/

        Carbon::macro('timelyGreeting', function() {
            return match (true) {
                now()->isAfter(Carbon::parse('today 6pm')) => 'Good Evening',
                now()->isAfter(Carbon::parse('today 12pm')) => 'Good Afternoon',
                now()->isAfter(Carbon::parse('today 12am')) => 'Good Morning',
            };
        });
    }
}
