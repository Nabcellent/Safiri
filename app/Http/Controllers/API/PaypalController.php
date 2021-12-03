<?php

namespace App\Http\Controllers\API;

use AmrShawky\Currency;
use App\Http\Controllers\Controller;
use App\Models\PaypalCallback;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaypalController extends Controller
{
    public function index(): Factory|View|Application {
        $data['paypalPayments'] = PaypalCallback::with([
            'video' => function($query) {
                $query->select(['id', 'user_id', 'title']);
            }
        ])->select(['id', 'video_id', 'amount', 'payer_email', 'status', 'created_at'])->latest()->get();

        return view('admin.payments.paypal', $data);
    }

    public function store(Request $request): JsonResponse {
        $payLoad = $request->input('payload');

        try {
            $data['booking_id'] = $request->input('booking_id');
            $data['status'] = strtolower($payLoad['status']);

            if($payLoad['status'] === 'COMPLETED') {
                $data['payload_id'] = $payLoad['id'];
                $data['payer_email'] = $payLoad['payer']['email_address'];
                $data['amount'] = $this->dollarsToKSH($payLoad['purchase_units'][0]['amount']['value']);
                $data['created_at'] = now();
                $data['updated_at'] = now();
            } else {
                $data['order_id'] = $payLoad['orderID'];
            }

            $paymentId = PaypalCallback::insertGetId($data);

            return response()->json(['status' => true, 'id' => $paymentId]);
        } catch (QueryException | Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong',
                'content' => $e->getMessage()
            ]);
        }
    }

    /**
     * @throws Exception
     */
    private function dollarsToKSH($amount): float {
        return Currency::convert()->from('USD')->to('KES')->amount($amount)->round(2)->get();
    }
}
