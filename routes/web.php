<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
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
    Route::get('/booking/{id}', [DestinationController::class, 'booking'])->name('show.booking');
});



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/destinations')->name('destination.')->group(function() {
        Route::get('/', [DestinationController::class, 'index'])->name('index');
    });
});


require __DIR__ . '/auth.php';
