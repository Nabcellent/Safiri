<?php


namespace App\Helpers;


use App\Models\Booking;
use App\Models\Destination;
use App\Models\PayPalCallback;
use App\Models\Setting;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class Help
{
    private int $counter = 0;

    /**
     * Help constructor.
     */
    public function __construct() { }

    public static function getSetting(string|array $type) {
        if(is_array($type)) {
            return Setting::whereIn('type', $type)->select(['type', 'description'])->get()
                ->mapWithKeys(function($setting) {
                    return [$setting->type => $setting->description];
                });
        }

        return Setting::where('type', $type)->first()->description;
    }

    public static function getAge($dob): int {
        return Carbon::now()->diffInYears($dob);
    }

    public static function json($msg, $ok = TRUE, $arr = []): JsonResponse {
        return $arr
            ? response()->json($arr)
            : response()->json(['ok' => $ok, 'msg' => $msg]);
    }

    public static function jsonStoreOk(): JsonResponse {
        return self::json(__('msg.store_ok'));
    }

    public static function goWithInfo($to, $msg): RedirectResponse {
        $route = $to
            ? self::goToRoute($to)
            : back();

        return $route->with('toast_info', $msg);
    }

    public static function goWithSuccess($to, $msg): RedirectResponse {
        $route = $to
            ? self::goToRoute($to)
            : back();

        return $route->with('toast_success', $msg);
    }

    public static function goWithDanger($to = 'dashboard', $msg = NULL): RedirectResponse {
        $msg = $msg
            ? $msg
            : __('msg.rnf');
        return self::goToRoute($to)->with('flash_danger', $msg);
    }

    public static function goToRoute($goto): RedirectResponse {
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

    public static function updateOk($msg = 'Update successful!', $routeName = null): RedirectResponse {
        return self::goWithSuccess($routeName, __($msg));
    }

    public static function createOk($msg = 'Created successfully!', $routeName = null): RedirectResponse {
        return self::goWithSuccess($routeName, __($msg));
    }

    public static function deleteOk($routeName = null): RedirectResponse {
        return self::goWithSuccess($routeName, __('msg.del_ok'));
    }

    public static function toastInfo($msg, $routeName = null): RedirectResponse {
        return self::goWithInfo($routeName, $msg);
    }

    public static function toastError($serverError, $clientMessage): RedirectResponse {
        Log::error($serverError);

        return back()->withInput()->with('toast_error', __($clientMessage));
    }

    public static function sweetInfo($msg, $routeName = null): RedirectResponse {
        $route = $routeName
            ? self::goToRoute($routeName)
            : back();

        return $route->with('sweet_info', $msg);
    }

    public static function sweetError($serverError, $clientMessage): RedirectResponse {
        Log::error($serverError);

        return back()->withInput()->with('sweet_error', __($clientMessage));
    }


    public static function getModel($model): string {
        $table = Str::snake(Str::plural($model));

        return match ($table) {
            'users' => User::class,
            'destinations' => Destination::class,
            'bookings' => Booking::class,

            'settings' => Setting::class,
            'pay_pal_callbacks' => PayPalCallback::class,
        };
    }


    public static function filterVideos(Request $request, $videoBuilder): Collection|Redirector|Application|RedirectResponse {
        $videos = $videoBuilder->whereHas('videoSetting', function($query) {
            $age = Auth::user()->age();
            $query->whereIn('target_gender', ['both', Auth::user()->gender])->where([
                    ['min_age', '<=', $age],
                    ['max_age', '>=', $age]
                ]);
        })->get();

        return (new Help)->filterByLocation($request, $videos);
    }

    public function filterByLocation(Request $request, $videos): Collection|Redirector|Application|RedirectResponse {
        if(Session::exists('userPosition')) {
            $userPosition = Session::get('userPosition');

            return $videos->filter(function($item) use ($userPosition) {
                $video = $item->videoSetting;
                $radius = $video->target_radius / 1000;

                return self::arePointsNear($userPosition, $video, $radius);
            });
        } else {
            return Collection::empty();
        }
    }

    /**
     * @param $userCheckPoint
     * @param $videoCenterPoint
     * @param $radiusKm
     * @return bool
     */
    public static function arePointsNear($userCheckPoint, $videoCenterPoint, $radiusKm): bool {
        $ky = 40000 / 360;
        $kx = cos(pi() * $videoCenterPoint->target_lat / 180.0) * $ky;
        $dx = abs($videoCenterPoint->target_lng - (float)$userCheckPoint->longitude) * $kx;
        $dy = abs($videoCenterPoint->target_lat - (float)$userCheckPoint->latitude) * $ky;

        return sqrt($dx * $dx + $dy * $dy) <= $radiusKm;
    }

    public static function generateReferralCode(int $userId, $length = 7): string {
        $codeLength = ($length - strlen($userId));
        $referralCode = str_shuffle($userId . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $codeLength));

        while(User::where('referral_code', $referralCode)->exists()) self::generateReferralCode($userId, $length);

        return $referralCode;
    }
}
