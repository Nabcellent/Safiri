<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\API\StkController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('/destinations')->name('destinations.')->group(function() {
    Route::get('/', [DestinationController::class, 'index'])->name('index');
    Route::get('/show/{id}', [DestinationController::class, 'show'])->name('show');
    Route::get('/booking/{id}', [BookingController::class, 'booking'])->name('show.booking');
    Route::post('/booking/{id}', [BookingController::class, 'reserve'])->name('reserve');
});

Route::get('/thanks',[BookingController::class,'thanks'])->name('thanks');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/destinations')->middleware('auth')->name('destinations.')->group(function() {
        Route::get('/', [AdminDestinationController::class, 'index'])->name('index');
        Route::post('/store', [AdminDestinationController::class, 'store'])->name('store');
    });
    //  MPESA ROUTES
    Route::prefix('/payments')->name('mpesa.stk.')->namespace('Mpesa')->group(function() {
        Route::any('stk-request', [StkController::class, 'initiatePush'])->name('request');
        Route::get('stk-status/{id}', [StkController::class, 'stkStatus']);
    });
});


require __DIR__ . '/auth.php';
