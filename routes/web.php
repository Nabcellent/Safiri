<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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



Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/destinations')->middleware('auth')->name('destination.')->group(function() {
        Route::get('/', [DestinationController::class, 'index'])->name('index');
    });
});

//  AUTH ROUTES
Route::prefix('/admin')->name('admin.')->middleware('guest')->group(function() {
    Route::get('/login', [AuthenticatedSessionController::class, 'login'])->middleware('guest')->name('login');
    Route::get('/register', [AuthenticatedSessionController::class, 'register'])->middleware('guest')->name('register');
});
