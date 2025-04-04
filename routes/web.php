<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\RoomsController;
use App\http\controllers\Bookings;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin-dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

//booking folder all urls
Route::get('/admin-dashboard/booking-list',[Bookings::class ,'index'])->name('bookinglist');
Route::get('/admin-dashboard/create-booking',[Bookings::class ,'create'])->name('newbooking');
Route::post('/admin-dashboard/create-booking',[Bookings::class ,'store'])->name('booking_store');
Route::get('/admin-dashboard/checkout-booking',[Bookings::class ,'checkout_index'])->name('checkot_booking');
Route::post('/admin-dashboard/checkout-booking/search', [Bookings::class ,'checkout_search'])->name('checkout_search');
//booking folder all urls
Route::get('/admin-dashboard/create-booking/{booking}/invoice', [Bookings::class ,'invoice'])->name('booking_invoice');
//room invemtry routes
Route::get('/admin-dashboard/add-room',[RoomsController::class ,'Addrooms'])->name('addroom');
Route::post('/admin-dashboard/create-room',[RoomsController::class ,'store'])->name('store');
Route::get('/admin-dashboard/show-room',[RoomsController::class ,'index'])->name('allroom');
//room invemtry routes