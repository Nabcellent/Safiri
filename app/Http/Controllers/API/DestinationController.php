<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use SKAgarwal\GoogleApi\Exceptions\GooglePlacesApiException;
use SKAgarwal\GoogleApi\PlacesApi;

class DestinationController extends Controller {
    public static $storagePath;
    public static $thumbPath;
    public static $maxWidth;

    protected $apiEndpoint = 'https://maps.googleapis.com/maps/api/place/photo';
    private $key;

    public function __construct() {
        $this->key = env('GOOGLE_PLACES_API_KEY');
    }

    /**
     * @throws GooglePlacesApiException
     */
    public function index(): JsonResponse {
        $googlePlaces = new PlacesApi(env('GOOGLE_PLACES_API_KEY'));

        $response = $googlePlaces->nearbySearch('-1.286389,36.817223', 800);

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

    public function photos($result): Collection {
        $retArr = collect();

        if(isset($result['photos']) && is_array($result['photos'])) {
            foreach($result['photos'] as $photo) {
                $retArr->add($this->url($photo));
            }
        }

        return $retArr;
    }

    /**
     * Get Google Image URL
     *
     * @param        $attributes
     * @param string $maxWidth
     * @return string
     */
    public function url($attributes, string $maxWidth = ''): string {
        $params = [
            'photoreference' => $attributes['photo_reference'],
            'key'            => $this->key,
        ];

        if(!empty($maxWidth)) {
            $params['maxwidth'] = $maxWidth;
        } else if(!empty(static::$maxWidth)) {
            $params['maxwidth'] = $maxWidth;
        } else {
            $params['maxwidth'] = $attributes['width'] ?? 400;
        }

        return $this->apiEndpoint . '?' . http_build_query($params);
    }


    /**
     * @throws Exception
     */
    public function save($storagePath = '', $maxWidth = '') {
        if(!empty($storagePath)) {
            $pathToSave = $storagePath;
        } else if(!empty(static::$storagePath)) {
            $pathToSave = static::$storagePath;
        } else {
            throw new Exception('Storage path must be defined');
        }

        $fileName = trim($pathToSave, "/") . '/' . uniqid() . '.jpg';

        $ch = curl_init($this->url($maxWidth));
        $fp = fopen($fileName, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }
}
