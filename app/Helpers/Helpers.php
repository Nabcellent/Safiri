<?php

/*+++ +++ +++ --- --- ---  +++ +++ +++ --- --- ---  +++ +++ +++ --- --- ---  +++ +++ +++ --- --- ---  USER TYPES  */

use App\Models\Category;
use App\Models\Setting;
use Faker\Factory;
use Illuminate\Http\RedirectResponse;
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
    function appendToApiDestination($destination, $image = null) {
        $destination['image'] = $image ?? savePhoto($destination['photo']);
        $destination['category_id'] = Category::whereIn('title', $destination['types'])->inRandomOrder()->first()->id;
        $destination['price'] = Factory::create()->randomFloat('2', 1000, 100000);
        $destination['distance'] = Factory::create()->randomFloat('2', 10, 1000);
        $destination['location'] = $destination['geometry']['location'];

        return $destination;
    }
}
if(!function_exists('savePhoto')) {
    function savePhoto(string $url): string {
        $imageName = uniqid() . Factory::create()->randomElement(['.png', '.jpg']);
        $filePath = public_path("/images/destinations/$imageName");

        file_put_contents($filePath, file_get_contents($url));

        return $imageName;
    }
}
