<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DestinationController extends Controller
{
    /**
     * @return Response|RedirectResponse
     */
    public function index(): Response|RedirectResponse {
        try {
            $data = [
                'destinations' => Destination::paginate(10),
                'categories' => Category::select(['id', 'title'])->get(),
                'vicinities' => Destination::select('vicinity')->distinct()->take(10)->get()->reject(function($vicinity) {
                    return strlen($vicinity->vicinity) > 30;
                }),
            ];

            return response()->view('destinations',$data);
        } catch (Exception) {
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
