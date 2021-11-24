<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\PaymentMethod;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function booking(int $id): Response|RedirectResponse {
        try {
            $data = [
                'destination' => Destination::with(['category'])->findOrFail($id),
            ];

            return response()->view('booking', $data);
        } catch (Exception $e) {
            return failNotFound();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function reserve(Request $request) {
        $data = $request->all();

        foreach(explode('~', $data['dates']) as $key => $date) {
            $key = $key === 0 ? 'start_at' : 'end_at';

            $data[$key] = Carbon::createFromFormat('d/m/Y', trim($date));
        }

        $data['payment_method_id'] = PaymentMethod::whereName($data['payment_method'])->first()->id;

        $booking = Auth::user()->bookings()->create($data);

        dd($booking);
    }

    public function thanks(): Factory|View|Application {
        $data = [
            "suggestedDestinations" => Destination::inRandomOrder()->take(7)->get(),
        ];

        return View('thanks', $data);

    }
}
