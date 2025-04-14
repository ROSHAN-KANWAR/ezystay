<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\RoomsController;
use App\http\controllers\BookingController;
use App\http\controllers\DashboardsController;
use App\http\controllers\UsersController;
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

Route::get('/', [DashboardsController::class ,'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    // All your admin routes here

    Route::get('/admin-dashboard',[DashboardsController::class ,'dashboard'])->name('dashboard');

    //booking folder all urls
    Route::get('/admin-dashboard/booking-list',[BookingController::class ,'index'])->name('bookinglist');
    Route::get('/admin-dashboard/create-booking/{roomId}', [BookingController::class, 'getroomid'])->name('getroomid');
   
    Route::get('/admin-dashboard/create-booking',[BookingController::class ,'create'])->name('newbooking');
    Route::post('/admin-dashboard/create-booking',[BookingController::class ,'store'])->name('booking_stores');
    Route::get('/admin-dashboard/checkout-booking',[BookingController::class ,'checkout_index'])->name('checkot_booking');
    Route::post('/admin-dashboard/checkout-booking/search_result', [BookingController::class ,'checkout_search'])->name('checkout_search');
    Route::get('/admin-dashboard/checkout-booking/ckeckout_result/{roomid}', [BookingController::class ,'checkout_roomid'])->name('checkout_roomid');
    
    Route::post('/process/{bookingId}', [BookingController::class, 'checkout'])->name('checkout_com');
    //booking folder all urls
    Route::get('/admin-dashboard/create-booking/{booking}/invoice', [BookingController::class ,'invoice'])->name('booking_invoice');
    //room invemtry routes
    Route::get('/admin-dashboard/add-room',[RoomsController::class ,'Addrooms'])->name('addroom');
    Route::post('/admin-dashboard/create-room',[RoomsController::class ,'store'])->name('store');
    Route::get('/admin-dashboard/update-room/{room_id}',[RoomsController::class ,'edit_room'])->name('update_room');
    Route::put('/admin-dashboard/update-room/{id}',[RoomsController::class ,'update_room'])->name('update_done_room');
    Route::get('/admin-dashboard/show-room',[RoomsController::class ,'index'])->name('allroom');
    //room invemtry routes
    /////////////////
    Route::get('/admin-dashboard/documents/print/{booking}', [BookingController::class, 'printDocuments'])->name('documentsprint');
    //document upload feature
    //Route::get('/admin-dashboard/add-document',[BookingController::class ,'add_document_index'])->name('add_document');
    Route::get('/admin-dashboard/add-document/upload-document/{id}', [BookingController::class ,'add_document_upload'])->name('add_document_upload');
    Route::post('/admin-dashboard/add-document/upload-document-1', [BookingController::class ,'store_document'])->name('add_document_upload_store');
    Route::get('/admin-dashboard/create-booking-2/{id}', [BookingController::class, 'step2'])->name('bookingstep2');
    // new booking ursl
    
    Route::post('/admin-dashboard/create-booking1',[BookingController::class ,'store1'])->name('booking_store1');
});
//register and login urls

Route::get('/register-form',[UsersController::class ,'Form_register'])->name('register_form');

Route::post('/register-form',[UsersController::class ,'Store_register'])->name('store_register');

Route::post('/login-form',[UsersController::class ,'Login_data'])->name('login_data');

Route::post('/logout',[UsersController::class ,'Logout'])->name('logout');
