<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use SKAgarwal\GoogleApi\Exceptions\GooglePlacesApiException;
use SKAgarwal\GoogleApi\PlacesApi;

class DestinationController extends Controller
{
    /**
     * @throws GooglePlacesApiException
     * @throws Exception
     */
    public function index(): JsonResponse {
        $googlePlaces = new PlacesApi(env('GOOGLE_PLACES_API_KEY'));

        $response = $googlePlaces->nearbySearch('-1.286389, 36.817223', 800);

        if($response['status'] === "OK") {
            $destinations = $response['results']->map(function($result) {
                $result['photo'] = $this->photos($result)->first();
                unset($result['photos']);

                return $result;
            });

            return response()->json($destinations);
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
