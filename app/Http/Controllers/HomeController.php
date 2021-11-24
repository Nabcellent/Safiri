<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Destination;
use Illuminate\Http\Response;

class HomeController extends Controller {
    public function index(): Response {
        $data = [
            'destinations' => Destination::take(10)->get(),
            'banners' => Banner::all()
        ];

        return response()->view('home', $data);
    }
}
