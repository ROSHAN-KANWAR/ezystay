<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\RoomsController;
use App\http\controllers\Bookings;
use App\http\controllers\DashboardController;
use App\http\controllers\Usercontroller;
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

Route::get('/', [DashboardController::class ,'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    // All your admin routes here

    Route::get('/admin-dashboard',[dashboardController::class ,'dashboard'])->name('dashboard');

    //booking folder all urls
    Route::get('/admin-dashboard/booking-list',[Bookings::class ,'index'])->name('bookinglist');
    Route::get('/admin-dashboard/create-booking',[Bookings::class ,'create'])->name('newbooking');
    Route::post('/admin-dashboard/create-booking',[Bookings::class ,'store'])->name('booking_store');
    Route::get('/admin-dashboard/checkout-booking',[Bookings::class ,'checkout_index'])->name('checkot_booking');
    Route::post('/admin-dashboard/checkout-booking/search_result', [Bookings::class ,'checkout_search'])->name('checkout_search');
    Route::post('/process/{bookingId}', [Bookings::class, 'checkout'])->name('checkout_com');
    //booking folder all urls
    Route::get('/admin-dashboard/create-booking/{booking}/invoice', [Bookings::class ,'invoice'])->name('booking_invoice');
    //room invemtry routes
    Route::get('/admin-dashboard/add-room',[RoomsController::class ,'Addrooms'])->name('addroom');
    Route::post('/admin-dashboard/create-room',[RoomsController::class ,'store'])->name('store');
    Route::get('/admin-dashboard/update-room/{room_id}',[RoomsController::class ,'edit_room'])->name('update_room');
    Route::put('/admin-dashboard/update-room/{id}',[RoomsController::class ,'update_room'])->name('update_done_room');
    Route::get('/admin-dashboard/show-room',[RoomsController::class ,'index'])->name('allroom');
    //room invemtry routes
    
});
//register and login urls

// Route::get('/register-form',[Usercontroller::class ,'Form_register'])->name('register_form');

// Route::post('/register-form',[Usercontroller::class ,'Store_register'])->name('store_register');

Route::post('/login-form',[Usercontroller::class ,'Login_data'])->name('login_data');

Route::post('/logout',[Usercontroller::class ,'Logout'])->name('logout');
