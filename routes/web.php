<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\API\PaypalController;
use App\Http\Controllers\API\StkController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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
    Route::get('/booking/{id}', [BookingController::class, 'booking'])->middleware('auth')->name('show.booking');
    Route::post('/booking/{id}', [BookingController::class, 'reserve'])->middleware('auth')->name('reserve');
    Route::get('/filter', [DestinationController::class, 'filter'])->name('filter');
});

Route::middleware(['auth'])->group(function() {
    //  USER ROUTES
    Route::prefix('/user')->middleware('auth')->name('user.')->group(function() {
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::get('/account', [UserController::class, 'account'])->name('account');
        Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
        Route::put('/password', [UserController::class, 'updatePassword'])->name('password.modify');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    //  PAYMENT ROUTES
    Route::prefix('/payments')->name('payments.')->group(function() {
        Route::any('stk-request', [StkController::class, 'initiatePush'])->name('request');
        Route::get('stk-status/{id}', [StkController::class, 'stkStatus']);
    });
    Route::post('/payments/paypal-callback', [PaypalController::class, 'store']);

    Route::get('/thanks', [BookingController::class, 'thanks'])->name('thanks');
});


/**~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *                                      ADMIN ROUTES
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::prefix('/admin')->name('admin.')->middleware(['auth', 'admin'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //  DESTINATION ROUTES
    Route::prefix('/destinations')->name('destinations.')->group(function() {
        Route::get('/', [AdminDestinationController::class, 'index'])->name('index');
        Route::get('/api', [AdminDestinationController::class, 'apiIndex'])->name('api.index');
        Route::get('/create', [AdminDestinationController::class, 'create'])->name('create');
        Route::post('/store', [AdminDestinationController::class, 'store'])->name('store');
        Route::get('/show/{id}', [AdminDestinationController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [AdminDestinationController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AdminDestinationController::class, 'update'])->name('update');
        Route::post('/store-api', [AdminDestinationController::class, 'storeApi'])->name('store-api');
        Route::get('/find-place', [AdminDestinationController::class, 'findPlace'])->name('find-place');
    });

    //  BOOKING ROUTES
    Route::prefix('/bookings')->name('bookings.')->group(function() {
        Route::get('/', [AdminBookingController::class, 'index'])->name('index');
        Route::get('/show/{id}', [AdminBookingController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [AdminBookingController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AdminBookingController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [AdminBookingController::class, 'destroy'])->name('destroy');
    });

    //  BANNER ROUTES
    Route::prefix('/banners')->name('banners.')->group(function() {
        Route::get('/', [BannerController::class, 'index'])->name('index');
        Route::post('/store', [BannerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BannerController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [BannerController::class, 'destroy'])->name('destroy');
    });

    //  USER ROUTES
    Route::prefix('/users')->name('users.')->group(function() {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::post('/store', [AdminUserController::class, 'store'])->name('store');
        Route::get('/show/{id}', [AdminUserController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AdminUserController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
    });

    Route::delete('/delete', [AjaxController::class, 'destroy'])->name('destroy');
});


require __DIR__ . '/auth.php';
