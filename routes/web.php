<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
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



/**~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *                                      ADMIN ROUTES
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
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

    //  MPESA PAYMENT ROUTES
    Route::prefix('/payments')->name('mpesa.stk.')->namespace('Mpesa')->group(function() {
        Route::any('stk-request', [StkController::class, 'initiatePush'])->name('request');
        Route::get('stk-status/{id}', [StkController::class, 'stkStatus']);
    });
});


require __DIR__ . '/auth.php';
