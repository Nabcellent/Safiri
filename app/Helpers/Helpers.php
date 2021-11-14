<?php

/*+++ +++ +++ --- --- ---  +++ +++ +++ --- --- ---  +++ +++ +++ --- --- ---  +++ +++ +++ --- --- ---  USER TYPES  */

use App\Models\Category;
use App\Models\Setting;
use Ballen\Distical\Calculator as DistanceCalculator;
use Ballen\Distical\Entities\LatLong;
use Faker\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * ----------------------------------------------------------------------------------------    MIDDLEWARE HELPERS
 */
if(!function_exists('isAdmin')) {
    function isAdmin(): bool {
        return in_array(Auth::user()->is_admin, [true, 7]);
    }
}
if(!function_exists('isRed')) {
    function isRed(): bool {
        return Auth::user()->is_admin === 7;
    }
}


/**
 * ----------------------------------------------------------------------------------------    ALERT HELPERS
 */
if(!function_exists('updateOk')) {
    function updateOk($msg = 'Update successful!', $routeName = null): RedirectResponse {
        return goWithSuccess($routeName, __($msg));
    }
}
if(!function_exists('createOk')) {
    function createOk($msg = 'Created successfully!', $routeName = null): RedirectResponse {
        return goWithSuccess($routeName, __($msg));
    }
}
if(!function_exists('createFail')) {
    function createFail($msg = 'Creation Failed!', $routeName = null): RedirectResponse {
        return goWithError(__($msg), $routeName);
    }
}
if(!function_exists('deleteOk')) {
    function deleteOk($routeName = null): RedirectResponse {
        return goWithSuccess($routeName, __('msg.del_ok'));
    }
}
if(!function_exists('failNotFound')) {
    function failNotFound($msg = 'The resource you requested was not found!', $routeName = null): RedirectResponse {
        return goWithError(__($msg), $routeName);
    }
}
if(!function_exists('toastInfo')) {
    function toastInfo($msg, $routeName = null): RedirectResponse {
        return goWithInfo($routeName, $msg);
    }
}
if(!function_exists('toastError')) {
    function toastError($serverError, $clientMessage): RedirectResponse {
        Log::error($serverError);

        return back()->withInput()->with('toast_error', __($clientMessage));
    }
}
if(!function_exists('sweetInfo')) {
    function sweetInfo($msg, $routeName = null): RedirectResponse {
        $route = $routeName
            ? goToRoute($routeName)
            : back();

        return $route->with('sweet_info', $msg);
    }
}
if(!function_exists('sweetError')) {
    function sweetError($serverError, $clientMessage): RedirectResponse {
        Log::error($serverError);

        return back()->withInput()->with('sweet_error', __($clientMessage));
    }
}
if(!function_exists('goWithInfo')) {
    function goWithInfo($to, $msg): RedirectResponse {
        $route = $to
            ? goToRoute($to)
            : back();

        return $route->with('toast_info', $msg);
    }
}
if(!function_exists('goWithSuccess')) {
    function goWithSuccess($to, $msg): RedirectResponse {
        $route = $to
            ? goToRoute($to)
            : back();

        return $route->with('toast_success', $msg);
    }
}
if(!function_exists('goWithDanger')) {
    function goWithDanger($to = 'dashboard', $msg = NULL): RedirectResponse {
        $msg = $msg
            ? : __('msg.rnf');
        return goToRoute($to)->with('flash_danger', $msg);
    }
}
if(!function_exists('goWithError')) {
    function goWithError($msg = "Error...! ☹", $to = null): RedirectResponse {
        $route = $to
            ? goToRoute($to)
            : back();

        return $route->with('toast_error', $msg);
    }
}
if(!function_exists('goToRoute')) {
    function goToRoute($goto): RedirectResponse {
        $data = [];
        $to = (is_array($goto)
            ? $goto[0]
            : $goto)
            ? : 'dashboard';

        if(is_array($goto)) {
            array_shift($goto);
            $data = $goto;
        }

        if(!Route::has($to)) {
            $to = app('router')->getRoutes()->match(app('request')->create($to))->getName();
        }

        return app('redirect')->to(route($to, $data));
    }
}


if(!function_exists('getSetting')) {
    function getSetting($type) {
        return Setting::whereType($type)->first()->description;
    }
}


/**
 * ----------------------------------------------------------------------------------------    GOOGLE API HELPERS
 */
if(!function_exists('getPhotoUrl')) {
    /**
     * @throws Exception
     */
    function getPhotoUrl($photoReference, $key = null, string $maxWidth = ''): string {
        $apiKey = $key ?? env('GOOGLE_PLACES_API_KEY');

        if(!$apiKey) throw new Exception("Api Key required");

        $params = [
            'photoreference' => $photoReference,
            'key'            => $apiKey,
        ];

        if(!empty($maxWidth)) {
            $params['maxwidth'] = $maxWidth;
        } else {
            $params['maxwidth'] = $attributes['width'] ?? 400;
        }

        return config('google.places.base_url') . 'photo?' . http_build_query($params);
    }
}
if(!function_exists('appendToApiDestination')) {
    function appendToApiDestination($destination) {
        $destination['category_id'] = Category::whereTitle(Arr::first($destination['types']))->first()->id;
        $destination['price'] = calculatePrice($destination);
        $destination['location'] = $destination['geometry']['location'];

        return $destination;
    }
}
if(!function_exists('downloadPhoto')) {
    function downloadPhoto(string $url): string {
        $imageName = uniqid() . Factory::create()->randomElement(['.png', '.jpg']);
        $filePath = public_path("/images/destinations/$imageName");

        file_put_contents($filePath, file_get_contents($url));

        return $imageName;
    }
}
if(!function_exists('savePhotosAndReviews')) {
    function savePhotosAndReviews($destination, $destinationResult): bool {
        try {
            collect($destinationResult['reviews'])->take(3)->each(function($review) use ($destination) {
                $review = [
                    'destination_id' => $destination->id,
                    'name'           => $review['author_name'],
                    'comment'        => $review['text'],
                    'rating'         => $review['rating'],
                    'profile_photo'  => $review['profile_photo_url'],
                    'created_at'     => Carbon::createFromTimestampMs($review['time'])
                ];

                $destination->reviews()->updateOrCreate([
                    'name'           => $review['name'],
                    'destination_id' => $review['destination_id']
                ], $review);
            });

            if(!$destination->destinationImages()->exists()) {
                $photos = collect($destinationResult['photos'])->take(3)->map(function($photo) use ($destination) {
                    return [
                        'destination_id' => $destination->id,
                        'reference'      => $photo['photo_reference'],
                        'image'          => downloadPhoto(getPhotoUrl($photo['photo_reference']))
                    ];
                })->toArray();

                $destination->destinationImages()->insert($photos);
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
if(!function_exists('calculatePrice')) {
    function calculatePrice($destinationResult): float {
        $safiriLocation = new LatLong(-1.286389, 36.817223);
        $placeGeometry = $destinationResult['geometry']['location'];
        $placeLocation = new LatLong($placeGeometry['lat'], $placeGeometry['lng']);
        $distanceCalculator = new DistanceCalculator($safiriLocation, $placeLocation);

        $distance = [
            'km'    => $distanceCalculator->get()->asKilometres(),
            'miles' => $distanceCalculator->get()->asMiles(),
            'nm'    => $distanceCalculator->get()->asNauticalMiles(),
        ];

//        dd($destinationResult['user_ratings_total'] / $destinationResult['rating']);
        $price = $distance['nm'] * (pow($destinationResult['rating'] ?? ($distance['miles'] + 3), 3) * 70);

        return round($price * 2) / 2;
    }
}
