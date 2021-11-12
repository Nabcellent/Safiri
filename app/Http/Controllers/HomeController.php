<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Response;

class HomeController extends Controller {
    public function index(): Response {
        $data = [
            'destinations' => Destination::take(10)->get(),
        ];

//        dd($data['destinations']);

        return response()->view('home', $data);
    }
}
