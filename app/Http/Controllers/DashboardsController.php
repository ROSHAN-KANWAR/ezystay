<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardsController extends Controller
{
    public function index(){
        if(auth()->check()){
            return redirect()->route('dashboard');
        }
        return view('welcome');
    }
    public function dashboard(){
        
        $bookedrooms = Booking::with('room')->orderBy('id', 'desc')->get();
       
         $todayamount = Booking::whereBetween('created_at',
         [
            now()->startOfWeek(),
            now()->endOfWeek()
         ])
         ->sum('subtotal');
 
        $room = Room::all();
        return view('admin.dashboard',compact('bookedrooms','room' ,'todayamount'));
      
    }
}
