<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }


    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function profile(): Response {
        $data = [
            'user' => User::find(Auth::id()),
        ];

        return response()->view('profile', $data);
    }

    /**
     * Display the specified resource.
     *
     * @return RedirectResponse|Response
     */
    public function account(): Response|RedirectResponse {
//        try {
            $data = [
                'user' => User::withCount(['bookings', 'reviews'])->find(Auth::id()),
                "suggestedDestinations" => Destination::inRandomOrder()->take(7)->get(),
                "bookings" => Booking::whereUserId(Auth::id())->with(['destination' => function($query) {
                    $query->select(['id', 'name', 'price', 'rates', 'image']);
                }, 'paymentMethod' => function($query) {
                    $query->select(['id', 'name']);
                }])->latest()->get()
            ];

            $data['latestActiveBooking'] = $data['bookings']->firstWhere('end_at', '>', now());

            return response()->view('account', $data);
//        } catch (Exception $e) {
//            dd($e);
//            return failNotFound("Something went wrong.");
//        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        try {
            $data = $request->all();
            $data['phone'] = strlen($data['phone']) > 9 ? substr($data['phone'], -9) : $data['phone'];

            Auth::user()->update($data);

            return updateOk();
        } catch (Exception $e) {
            return toastError($e->getMessage(), "unable to update profile. 😢");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updatePassword(Request $request): RedirectResponse {
        try {
            Auth::user()->password = Hash::make($request->input('password'));
            Auth::user()->save();

            return updateOk();
        } catch (Exception $e) {
            return toastError($e->getMessage(), "unable to change password. 😢");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id) {
        Auth::user()->delete();

        return deleteOk("Account deleted successfully", 'home');
    }
}
