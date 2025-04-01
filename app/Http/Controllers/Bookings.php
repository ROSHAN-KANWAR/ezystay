<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Bookings extends Controller
{
    public function index(){
        return view('admin.Booking.bookinglist');
    }
    public function create(){
        return view('admin.Booking.createbooking');
    }
}
