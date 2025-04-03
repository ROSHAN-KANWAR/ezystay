<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class Bookings extends Controller
{
    public function index(){
        $bookedrooms = booking::all();
        return view('admin.Booking.bookinglist',compact('bookedrooms'));
    }
  
    public function create()
    {
        $availableRooms = Rooms::available()->select('id', 'room_no', 'type', 'price','floor') // Explicitly select fields
        ->orderBy('type')
        ->orderBy('room_no')
        ->get(['id','room_no','type','price','floor'])->groupBy('type'); ;
        return view('admin.booking.createbooking',compact('availableRooms'));
    }
  
    public function store(Request $request)
    {
    try{
            // Create booking with all request data
            $bookingData = $request->all();
            $room = Rooms::find($request->room_id);
            // Generate booking ID
            $bookingData['booking_id'] = $this->generateBookingId();
            
            // Create booking
            $booking = Booking::create($bookingData);
            $room->update(['status' => 'occupied']);

            return redirect()->route('allroom');
    }
            catch (\Exception $e) {
                // Rollback transaction on error
                DB::rollBack();
                
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create booking',
                    'error' => $e->getMessage()
                ], 500);
            }
    }
        private function generateBookingId()
        {
            $prefix = 'BK';
            $random = strtoupper(substr(uniqid(), -6));
            
            return "INV" . $prefix . $random;
        }
    
    } 
        
       



