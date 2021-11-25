<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    public function index(): Response {
        $data = [
            'bookings' => Booking::with([
                'user' => function($query) {
                    $query->select(['id', 'email']);
                },
                'destination' => function($query) {
                    $query->select(['id', 'name']);
                },
                'paymentMethod'
            ])->take(100)->latest()->get()
        ];

        return response()->view('admin.bookings.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response|RedirectResponse
     */
    public function show(int $id): Response|RedirectResponse {
        try {
            $data = [
                'booking' => Booking::with([
                    'destination' => function($query) {
                        $query->with(['category', 'destinationImages'])->withCount(['reviews', 'bookings'])->select([
                            'id',
                            'category_id',
                            'name',
                            'image',
                            'vicinity',
                            'website',
                            'rating',
                        ]);
                    }, 'user' => function($query) {
                        $query->select(['id', 'first_name','last_name']);
                    }
                ])->findOrFail($id),
            ];

//            dd($data['booking']);

            return response()->view('admin.bookings.show', $data);
        } catch (Exception $e) {
            dd($e);
            return toastError($e->getMessage(), "Something went wrong!");
        }
    }
}
