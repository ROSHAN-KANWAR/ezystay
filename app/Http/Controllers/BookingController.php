<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Str;
class BookingController extends Controller
{
    public function index(){
        $bookedrooms = booking::with('room')->orderBy('id', 'desc')->get();
        return view('admin.booking.bookinglist',compact('bookedrooms'));
    }
  
    public function create()
    {
        $availableRooms = Room::all()
        ->groupBy('floor');
    
    // Get additional data that might be useful for the booking form
    $roomTypes = Room::distinct()->pluck('floor');
    $floors = Room::distinct()->pluck('floor')->sort();
    
    return view('admin.booking.onlyroomnumber', compact('availableRooms', 'roomTypes', 'floors'));
    }
  public function getroomid($roomid){
    $room = Room::find($roomid);
    return view('admin.booking.createbooking2', compact('room'));
   
  }
    public function store(Request $request)
    {
        try{
                // Create booking with all request data
                $bookingData = $request->all();
                $room = Room::find($request->room_id);
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
            
        do {
            $bookingId = 'BK' . strtoupper(Str::random(6)) . now()->format('dmY');
        } while (Booking::where('booking_id', $bookingId)->exists());

        return $bookingId;
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
//onlyroomnumber direct checkout
public function checkout_roomid($roomId){
    $booking = Booking::whereHas('room', function($query) use ($roomId) {
        $query->where('id', $roomId)
              ->where('status', 'occupied');
      })
      ->where('status', 'checked_in')
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
        if (!$booking->document_verified) {
            return view('admin.booking.checkout_result')->with('error', 'Cannot check out. Guest documents have not been verified!');
        }
    // Update booking status
    $booking->update(['status' => 'checked_out']);
    $booking->update(['payment_status' => 'paid']);
    $booking->update(['document_verified' => true]);
    // Update room status
    $booking->room->update(['status' => 'Maintenance']);

    // You might want to add payment processing here
   
    return redirect()->route('bookinglist');
    }
 
public function add_document_upload($booking_id){

    $booking = Booking::where('booking_id', $booking_id)->first();
        
        if (!$booking) {
            return back()->with('error', 'Booking not found');
        }
        if ($booking->document_verified) {
            return redirect()
                ->route('add_document') // Redirect to booking details
                ->with('error', 'Documents for this booking are already verified');
        }
    
    return view('admin.booking.add_document_upload' ,compact('booking'));
}
  // Process document uploads
  public function store_document(Request $request)
  {
      $request->validate([
          'booking_id' => 'required|exists:bookings,id',
          'guest_names' => 'required|array',
          'guest_names.*' => 'required|string',
          'document_types' => 'required|array',
          'document_types.*' => 'required|string|in:passport,id_card,driver_license,visa,other',
          'front_files' => 'required|array',
          'front_files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5048',
          'back_files' => 'nullable|array',
          'back_files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5048'
      ]);
  
      DB::beginTransaction();
  
      try {
          // Create directory if it doesn't exist
          $publicPath = public_path('uploads/guest_documents');
          if (!File::exists($publicPath)) {
              File::makeDirectory($publicPath, 0755, true);
          }
  
          foreach ($request->guest_names as $index => $guestName) {
              // Process front side
              $frontFile = $request->file('front_files')[$index];
              $frontFileName = 'booking_'.$request->booking_id.'_guest_'.($index+1).'_front_'.time().'.'.$frontFile->getClientOriginalExtension();
              $frontPath = 'uploads/guest_documents/'.$frontFileName;
              
              // Move to public folder
              $frontFile->move($publicPath, $frontFileName);
  
              Document::create([
                  'booking_id' => $request->booking_id,
                  'document_type' => $request->document_types[$index],
                  'file_path' => $frontPath,
                  'side' => 'front',
                  'guest_name' => $guestName,
                  'original_filename' => $frontFile->getClientOriginalName()
              ]);
  
              // Process back side if exists
              if (isset($request->file('back_files')[$index])) {
                  $backFile = $request->file('back_files')[$index];
                  $backFileName = 'booking_'.$request->booking_id.'_guest_'.($index+1).'_back_'.time().'.'.$backFile->getClientOriginalExtension();
                  $backPath = 'uploads/guest_documents/'.$backFileName;
                  
                  $backFile->move($publicPath, $backFileName);
  
                  Document::create([
                      'booking_id' => $request->booking_id,
                      'document_type' => $request->document_types[$index],
                      'file_path' => $backPath,
                      'side' => 'back',
                      'guest_name' => $guestName,
                      'original_filename' => $backFile->getClientOriginalName()
                  ]);
              }
          }
  
          // Update booking verification status
          $booking = Booking::where('id', $request->booking_id)
                    ->where('status', 'checked_in')
                    ->firstOrFail();
                  
          $booking->update([
              'document_verified' => true,
              'document_verified_at' => now()
          ]);
  
          DB::commit();
  
          return redirect()->route('bookinglist')->with('success', 'Documents uploaded and verified successfully!');
  
      } catch (\Exception $e) {
          DB::rollBack();
          return back()->with('error', 'Failed to upload documents: ' . $e->getMessage());
      }
  }
///print all document of single users
///print all document of single users
public function printDocuments($bookingId)
{
    $booking = Booking::findOrFail($bookingId);
    $documents = Document::where('booking_id', $bookingId)
                ->orderBy('guest_name')
                ->orderBy('side')
                ->get()
                ->groupBy('guest_name');
    
    return view('admin.booking.print', compact('booking', 'documents'));
}
    }



