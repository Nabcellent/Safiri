<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use SKAgarwal\GoogleApi\Exceptions\GooglePlacesApiException;
use SKAgarwal\GoogleApi\PlacesApi;

class DestinationController extends Controller
{
    /**
     * @throws GooglePlacesApiException
     * @throws Exception
     */
    public function index(Request $request): JsonResponse {
        $googlePlaces = new PlacesApi(env('GOOGLE_PLACES_API_KEY'));

        $location = $request->input('location') ?? '-1.286389,36.817223';
        $radius = $request->input('radius') ?? 1500;

        $params = [
            'pagetoken' => $request->input('pagetoken') ?? [],
            'rankby' => $request->input('rankby') ?? 'prominence',
        ];

        if($request->has('type')) $params['type'] = $request->input('type');

        $response = $googlePlaces->nearbySearch($location, $radius, $params);

        if($response['status'] === "OK") {
            $destinations = $response['results']->map(function($result) {
                $result['photo'] = $this->photos($result)->first();
                unset($result['photos']);

                return $result;
            });

            $data = [
                'next_page_token' => $response['next_page_token'],
                'destinations' => $destinations,
            ];

            return response()->json($data);
        }

        return response()->json(['msg' => 'Error!', 'status' => $response['status']], 400);
    }

    /**
     * @param $result
     * @return Collection
     * @throws Exception
     */
    public function photos($result): Collection {
        $retArr = collect();

        if(isset($result['photos']) && is_array($result['photos'])) {
            foreach($result['photos'] as $photo) {
                $retArr->add(getPhotoUrl($photo['photo_reference']));
            }
        }

        return $retArr;
    }
}
