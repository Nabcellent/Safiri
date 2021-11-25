<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    public function index(): Response {
        $data = [
            'annualIncome' => Booking::whereIsPaid(true)->whereBetween('created_at', [now()->startOfYear(), now()])
                ->sum('total'),
            'recentBookings' => Booking::with(['destination' => function($query) {
                $query->select(['id', 'name', 'image']);
            }])->latest()->take(5)->get()
        ];

        return response()->view('admin.dashboard', $data);
    }
}
