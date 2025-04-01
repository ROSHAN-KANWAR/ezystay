<?php

namespace App\Http\Controllers;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Bookings extends Controller
{
    public function index(){
        return view('admin.Booking.bookinglist');
    }
  
    public function create()
    {
      $rooms1= Rooms::getTypeOptions();
        return view('admin.booking.createbooking',compact('rooms1'));
    }

}

