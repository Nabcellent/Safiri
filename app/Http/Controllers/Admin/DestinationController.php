<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SaveDestination;
use App\Models\Category;
use App\Models\Destination;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SKAgarwal\GoogleApi\PlacesApi;
use Throwable;

class DestinationController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response {
        $data['savingDestinations'] = getSetting('saving_destinations');

        return response()->view('admin.destination.index', $data);
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function store(Request $request): JsonResponse {
        if($request->has('destinations')) {
            SaveDestination::dispatch($request->input('destinations'));

            return response()->json(['status' => true, 'message' => 'Saving destinations in background...']);
        } else if($request->has('place_id')) {
            $googlePlaces = new PlacesApi(env('GOOGLE_PLACES_API_KEY'));
            $details = $googlePlaces->placeDetails($request->input('place_id'));
            $photos = $details['result']['photos'];

            foreach($details['result']['types'] as $category) {
                Category::updateOrCreate(['title' => $category], ['title' => $category]);
            }

            $image = savePhoto(getPhotoUrl(array_shift($photos)['photo_reference']));

            $destination = Destination::updateOrCreate(['place_id' => $request->input('place_id')],
                appendToApiDestination($details['result'], $image));

            $photos = collect($photos)->take(3)->map(function($photo) use ($destination) {
                return [
                    'destination_id' => $destination->id,
                    'reference'      => $photo['photo_reference'],
                    'image'          => savePhoto(getPhotoUrl($photo['photo_reference']))
                ];
            })->toArray();

            $destination->destinationImages()->insert($photos);

            return response()->json(['status' => true, 'message' => 'Destination saved successfully!']);
        }

        return response()->json(['status' => false, 'message' => 'No destination(s) provided for saving.']);
    }
}
