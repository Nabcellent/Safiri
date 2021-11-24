<?php

namespace App\Http\Controllers\API;

use App\Helpers\Help;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStkRequest;
use App\Models\Booking;
use App\Models\StkRequest;
use DrH\Mpesa\Facades\STK;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\{Artisan, Log, Session};
use Illuminate\Support\Str;


class StkController extends Controller
{
    public function index(): Factory|View|Application {
        $requests = StkRequest::with(['user' => function($query) {
            $query->select(['id', 'email']);
        }, 'response' => function($query) {
            $query->select(['id', 'CheckoutRequestID', 'ResultDesc', 'Amount', 'TransactionDate', 'phoneNumber', 'created_at']);
        }, 'video' =>function($query) {
            $query->select(['id', 'title']);
        }])->select(['id', 'user_id', 'video_id', 'CheckoutRequestID', 'phone', 'created_at', 'status'])->latest()->get();

        return view('admin.payments.mpesa', ['requests' => $requests]);
    }
    /**
     * @param StoreStkRequest $request
     * @return JsonResponse
     */
    public function initiatePush(StoreStkRequest $request): JsonResponse {
        $data = $request->all();
        $phone = $data['phone'];
//        $amount = $request->input('amount');

        $phone = "254" . (Str::length($phone) > 9 ? Str::substr($phone, -9) : $phone);

        try {
            //  Send STK request to users phone and save the request
            $stkResponse = mpesa_request($phone, 1, 'Safiri', 'Payment made to Safiri');

            //  Save the booking
            Session::put('booking_id', BookingController::saveBooking($data)->id);

            //  Return STK checkout request id and wait for user to accept/decline payment
            return response()->json(['status' => true, 'requestId' => $stkResponse->CheckoutRequestID]);
        } catch(Exception $exception) {
            Log::debug($exception->getMessage());

            return response()->json(['status' => false, 'message' => 'Unable to process request at this time. Please try again shortly.']);
        }
    }

    public function queryStatus(): RedirectResponse {
        try {
            Artisan::queue('mpesa:query_status');

            return Help::updateOk('Querying Missing Requests... please refresh in a few.', url()->previous());
        } catch(Exception $e) {
            return Help::toastError($e->getMessage(), 'Unable to query status💔');
        }
    }

    /**
     * @param $reference
     * @return JsonResponse
     */
    public function stkStatus($reference): JsonResponse {
        try {
            $stkStatus = STK::validate($reference);
            $url = "";

            if(property_exists($stkStatus, 'errorCode')) {
                $status = 'processing';
                $message = $stkStatus->errorMessage | 'Waiting for customer response...';
            } else {
                $status = 'processed';
                $resultCode = (int)$stkStatus->ResultCode;

                if($resultCode === 0) {
                    $message = 'Payment Successful!';
                    $icon = 'success';
                    $url = route('thanks');

                    try {
                        $booking = Booking::findOrFail(Session::pull('booking_id'));
                        $booking->is_paid = true;
                        $booking->save();
                    } catch(Exception $e) {
                        Log::error($e->getMessage());
                        $message = 'Something went wrong. Kindly contact the Admin';
                        $icon = 'warning';
                    }
                } else if($resultCode === 1032) {
                    $message = 'Payment Cancelled';
                    $icon = 'info';
                } else if($resultCode === 1) {
                    $message = 'Your M-PESA balance is insufficient.';
                    $icon = 'info';
                } else {
                    $message = 'Something did not go right somewhere.';
                    $icon = 'warning';
                }

//                Artisan::queue('mpesa:query_status');

                return response()->json(['status' => $status, 'message' => $message, 'icon' => $icon, 'url' => $url]);
            }
        } catch(Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'failed', 'message' => 'Unable to complete transaction. please contact the admin.']);
        }

        return response()->json(['status' => $status, 'message' => $message]);
    }
}
