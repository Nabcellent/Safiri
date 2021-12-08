<?php

namespace App\Http\Controllers;

use App\Events\Reserved;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\PaymentMethod;
use App\Models\PaypalCallback;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
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
     * @return RedirectResponse
     */
    public function reserve(Request $request): RedirectResponse {
        $data = $request->all();

//        try {
            self::saveBooking($data);

            return redirect()->route('thanks');
//        } catch (Exception $e) {
//            return toastError($e->getMessage(), "Something went wrong.😢");
//        }
    }

    public static function saveBooking(array $data): Booking|Model {
        foreach(explode('~', $data['dates']) as $key => $date) {
            $key = $key === 0
                ? 'start_at'
                : 'end_at';

            $data[$key] = Carbon::createFromFormat('d/m/Y', trim($date));
        }

        $data['payment_method_id'] = PaymentMethod::whereName($data['payment_method'])->first()->id;
        $data['user_id'] = Auth::id();

        $booking = Booking::create($data);

        if(isset($data['is_paid']) && $payment = PaypalCallback::find($data['is_paid'])) {
            $payment->booking_id = $booking->id;
            $payment->save();
            $booking->is_paid = true;
            $booking->save();
        }

//        try {
            Reserved::dispatch($booking);
//        } catch (Exception $e) {
//            Log::error($e);
//        }

        return $booking;
    }

    public function thanks(): Factory|View|Application {
        $data = [
            "suggestedDestinations" => Destination::inRandomOrder()->take(7)->get(),
        ];

        return View('thanks', $data);
    }
}
