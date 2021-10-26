<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller {
    /**
     * Display the admin login view.
     *
     * @return View
     */
    public function login(): View {
        return view('admin.auth.login');
    }

    /**
     * Display the admin register view.
     *
     * @return View
     */
    public function register(): View {
        return view('admin.auth.register');
    }
}
