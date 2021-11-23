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
use Illuminate\Support\Arr;
use SKAgarwal\GoogleApi\PlacesApi;
use Throwable;

class DestinationController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response {
        $data['savingDestinations'] = getSetting('saving_destinations');

        return response()->view('admin.destinations.index', $data);
    }
    public function showList(): Response {
        $data = [
            'destinations' => Destination::with('category')->take(100)->get()
        ];

        return response()->view('admin.destinations.list', $data);
    }

    public function create(): Response {
        return response()->view('admin.destinations.upsert');
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
            $result = $googlePlaces->placeDetails($request->input('place_id'))['result'];
            $photos = $result['photos'];

            $category = ['title' => Arr::first($result['types'])];
            Category::updateOrCreate($category, $category);

            if(isset($result['opening_hours'])) $result['availability'] = $result['opening_hours'];

            $destination = Destination::updateOrCreate(['place_id' => $request->input('place_id')],
                appendToApiDestination($result));

            if(empty($destination->image)) {
                $destination->image = downloadPhoto(getPhotoUrl(array_shift($photos)['photo_reference']));
                $destination->save();
            }

            //  SAVE DESTINATION REVIEWS & PHOTOS *IF NOT EXISTS
            if(savePhotosAndReviews($destination, $result)) {
                return response()->json(['status' => true, 'message' => 'Destination saved successfully!']);
            } else {
                return response()->json(['status' => false, 'message' => 'Error saving destination assets!']);
            }
        }

        return response()->json(['status' => false, 'message' => 'No destination(s) provided for saving.']);
    }
}
