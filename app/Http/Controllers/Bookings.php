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
        $availableRooms = Rooms::available()->select('id', 'room_no', 'type', 'price','floor') // Explicitly select fields
        ->orderBy('type')
        ->orderBy('room_no')
        ->get(['id','room_no','type','price','floor'])->groupBy('type'); ;
        

        return view('admin.booking.createbooking',compact('availableRooms'));
    }

}

