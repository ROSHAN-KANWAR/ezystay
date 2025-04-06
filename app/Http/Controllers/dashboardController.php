<?php

namespace App\Http\Controllers;
use App\Models\booking;
use App\Models\rooms;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(){
        if(auth()->check()){
            return redirect()->route('dashboard');
        }
        return view('welcome');
    }
    public function dashboard(){
        
        $bookedrooms = booking::with('room')->orderBy('id', 'desc')->get();
       
         $todayamount = booking::whereBetween('created_at',
         [
            now()->startOfWeek(),
            now()->endOfWeek()
         ])
         ->sum('subtotal');
 
        $room = rooms::all();
        return view('admin.dashboard',compact('bookedrooms','room' ,'todayamount'));
      
    }
}
