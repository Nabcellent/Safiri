<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    public function index(): Response {
        $data = [
            'bookings' => Booking::with(['user' => function($query) {
                $query->select(['id', 'email']);
            }, 'destination' => function($query) {
                $query->select(['id', 'name']);
            }, 'paymentMethod'])->take(100)->latest()->get()
        ];

        return response()->view('admin.bookings.index', $data);
    }
}
