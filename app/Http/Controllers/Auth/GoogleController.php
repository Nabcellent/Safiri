<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GoogleController extends Controller
{
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle(): RedirectResponse {
        return Socialite::driver('google')->redirect();
    }

    /*
     * ---------    Google Response
     *
     * token, email_verified, locale
     * expiresIn
     * id, email
     * nickname, name
     * avatar, avatar_original
     * */
    public function handleCallback() {
        try {
            $googleUser = Socialite::driver('google')->user();

            $appUser = User::where('google_id', $googleUser->id)->first();

            if($appUser) {
                Auth::login($appUser);

                return redirect('/home');
            } else {
                return view('auth.register', ['googleUser' => $googleUser]);
            }
        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }
}
