<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Helpers\ChartAid;
use App\Models\Booking;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class RevenueChart extends BaseChart {
    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'revenue';

    /**
     * Determines the middlewares that will be applied
     * to the chart endpoint.
     */
    public ?array $middlewares = ['auth', 'admin'];

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan {
        $frequency = $request->has('frequency') ? $request->input('frequency') : 'weekly';

        $chartAid = new ChartAid($frequency, 'sum', 'total');

        $revenue = Booking::select(['created_at', 'total'])->whereBetween('created_at', [
            $chartAid->chartStartDate(), now()])
            ->where('is_paid', true)->get()->groupBy(function($item) use ($chartAid) {
                return $chartAid->chartDateFormat($item->created_at);
            });

        $revenue = $chartAid->chartDataSet($revenue);

        return Chartisan::build()
            ->labels($revenue['labels'])
            ->dataset('Amount of revenue', $revenue['datasets']);
    }
}
