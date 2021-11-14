<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class DestinationController extends Controller
{
    /**
     * @return Response|RedirectResponse
     */
    public function index(): Response|RedirectResponse {
        try {
            $data = [
                'destinations' => Destination::paginate(10),
            ];

            return response()->view('destinations',$data);
        } catch (Exception $e) {
            return failNotFound();
        }
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function reserve(Request $request) {
        $data = $request->all();
        $data['dates'] = collect(explode('~', $data['dates']))->mapWithKeys(function($date, $key) {
            $key = $key === 0 ? 'start_at' : 'end_at';

            return [$key => Carbon::createFromFormat('d/m/Y', trim($date))];
        });
        dd($data);
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
                'destination' => Destination::with(['destinationImages', 'category'])->findOrFail($id),
                "suggestedDestinations" => Destination::inRandomOrder()->take(7)->get(),
            ];

            return response()->view('details', $data);
        } catch (Exception $e) {
            return failNotFound();
        }
    }

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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @return Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id) {
        //
    }
}
