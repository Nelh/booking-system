<?php

use Nel\BookingSystem\Http\Livewire\ShowBooking;
use Nel\BookingSystem\Http\Livewire\CreateBooking;
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

Route::middleware(['web'])->group(function () {
    Route::get('/bookings/create', CreateBooking::class)->name('bookings');
    Route::get('/bookings/{appointment:uuid}', ShowBooking::class)->name('bookings.show');
});
