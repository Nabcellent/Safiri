<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Destination;
use App\Models\Review;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function index(): Response {
        $data = [
            'destinations' => Destination::take(30)->get(),
            'banners'      => Banner::all(),
            'testimonials' => Review::with(['destination' => function($query) {
                $query->select(['id', 'name','created_at']);
            }])->orderByDesc('rating')->latest()->select([
                'destination_id',
                'name',
                'comment',
                'created_at'
            ])->take(4)->get(),
        ];

        return response()->view('home', $data);
    }
}
