<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DestinationController extends Controller {
    public function index() {
        return response()->view('admin.destination.index');
    }
}
