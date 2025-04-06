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
        $bookedrooms = booking::with('room')->orderBy('id', 'desc')->get();
        return view('admin.Booking.bookinglist',compact('bookedrooms'));
    }
  
    public function create()
    {
        $availableRooms = Rooms::available()->select('id', 'room_no', 'type', 'price','floor') // Explicitly select fields
        ->orderBy('type')
        ->orderBy('room_no')
        ->get(['id','room_no','type','price','floor'])->groupBy('type'); 
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

            return redirect()->route('bookinglist');
    }
            catch (\Exception $e) {
               return redirect()->back()->with('error', $e->getMessage());
            }
    }
        private function generateBookingId()
        {
            $prefix = 'BK';
            $random = strtoupper(substr(uniqid(), -6));
            
            return "INV" . $prefix . $random;
        }
    public function invoice($booking_id){
      
        $booking = Booking::with('room')->where('booking_id', $booking_id)// Additional condition
        ->first();
        $today = now()->format('d-m-Y');
     
        $pr = $booking->room->price;
        $nigh = $booking->no_of_nights;
      
        $total = $pr*$nigh + $pr*$nigh*(12/100);
        $cgst = $total*(6/100);
        $sgst = $total* (6/100); 
        return view('admin.booking.invoice',compact('booking','today','cgst','sgst' ,'total'));
    }
    //checkout controller
    public function checkout_index(){
  
        return view('admin.booking.checkoutbooking');
    }
    public function checkout_search(Request $request){
        $request->validate(['search' => 'required']);
        $booking = Booking::where(function($query) use ($request) {
            $query->where('booking_id', $request->search)
                  ->where('status', 'checked_in')
                  ->orWhereHas('room', function($q) use ($request) {
                      $q->where('room_no', $request->search)
                        ->where('status', 'occupied');
                  })
                  ->where('status', 'checked_in'); // This ensures both cases require checked_in status
        })
        ->with(['room'])
        ->first();
        
    if (!$booking) {
        return back()->with('error', 'No occupied room or active booking found!');
    }
        return view('admin.booking.checkout_result' ,compact('booking'));
    }

    //checkou complete 
    public function checkout($bookingId){
        $booking = Booking::where('booking_id', $bookingId)
        ->where('status', 'checked_in')
        ->firstOrFail();

    // Update booking status
    $booking->update(['status' => 'checked_out']);
    $booking->update(['payment_mode' => 'Paid']);
    // Update room status
    $booking->room->update(['status' => 'Maintenance']);

    // You might want to add payment processing here
   
    return redirect()->route('bookinglist');
    }
    } 
    
        
       



