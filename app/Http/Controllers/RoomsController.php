<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
  //Show All Rooms Details
    public function index()
    {
      $rooms = Rooms::query()->orderBy('id','desc')->get();
      return view('admin.rooms.showallroom', compact('rooms'));
    }
//Add New Rooms Form
    public function Addrooms(){

      return view('admin.rooms.addroom',[
        'floorOptions' => Rooms::getFloorOptions(),
        'typeOptions' => Rooms::getTypeOptions(),
        'statusOptions' => Rooms::getStatusOptions()
      ]);
    }
    //Store a newly created resource in storage.
     
    public function store(Request $request)
    {
       
      $validated = $request->validate([
        'room_no' => 'required|unique:rooms|max:10',
        'price' => 'required|numeric|min:0',
        'floor' => 'required|in:'.implode(',', Rooms::getFloorOptions()),
        'type' => 'required|in:'.implode(',', array_keys(Rooms::getTypeOptions())),
        'status' => 'required|in:'.implode(',', array_keys(Rooms::getStatusOptions())),
        'capacity' => 'nullable|integer|min:1',
        'description' => 'nullable|string|max:500'
    ]);

    Rooms::create($validated);
        return redirect()->route('allroom')
            ->with('success', 'Room created successfully.');
    }
}